<?php

namespace App\Http\Controllers\Image;

use App\UploadFile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    // 一些常量
    const STATUS_UNKNOWN_TYPE = 5000;
    const STATUS_FILE_TOO_SMALL = 5001;
    const STATUS_FILE_TOO_LARGE = 5002;
    const STATUS_FILE_TYPE_ERROR = 5003;
    const STATUS_FILE_INVALID = 5004;
    const STATUS_ORIGIN_DISK_SAVE_ERROR = 5005;
    const STATUS_ORIGIN_DB_SAVE_ERROR = 5006;
    const STATUS_MAKE_THUMBNAIL_ERROR = 5007;
    const STATUS_THUMBNAIL_DISK_SAVE_ERROR = 5008;
    const STATUS_NO_SUCH_FILE_HAVE_UPLOADED = 5009;
    const STATUS_UPLOADED_FILE_NOT_FOUND = 50010;
    const STATUS_FAIL_TO_CROP_FILE = 50011;

    private $type;
    private $config;
    private $user;
    private $status;

    protected static $messages = [
        self::STATUS_UNKNOWN_TYPE => 'Unknown Type',
        self::STATUS_FILE_TOO_SMALL => '您上传的文件太小啦！',
        self::STATUS_FILE_TOO_LARGE => '您上传的文件太大啦！',
        self::STATUS_FILE_TYPE_ERROR => '文件格式错误，仅支持jpg，png，gif类型的文件！',
        self::STATUS_FILE_INVALID => '文件未上传成功！',
        self::STATUS_ORIGIN_DISK_SAVE_ERROR => '保存文件到磁盘失败！',
        self::STATUS_ORIGIN_DB_SAVE_ERROR => '数据库保存失败！',
        self::STATUS_MAKE_THUMBNAIL_ERROR => '制作缩略图失败！',
        self::STATUS_THUMBNAIL_DISK_SAVE_ERROR => '缩略图保存失败！',
        self::STATUS_NO_SUCH_FILE_HAVE_UPLOADED => '未找到图片的原始上传记录！',
        self::STATUS_UPLOADED_FILE_NOT_FOUND => '未找到图片的原始上传素材',
        self::STATUS_FAIL_TO_CROP_FILE => '裁剪图片失败！',

    ];


    public function __construct(Request $request)
    {
        $this->user = Auth::user();

        $this->type = $request->input('type');
    }

    //
    public function postUpload(Request $request)
    {
        $this->config = config('admin.image.operations.upload.' . $this->type);
        if (empty($this->config)) {
            $this->status = self::STATUS_UNKNOWN_TYPE;
            return $this->abort($this->status);
        }

        $file = $request->file('file');
        if ($file->isValid()) {
            if (!$this->isValid($file)) {
                return $this->abort($this->status);
            }

            $relativePath = $this->config['path'] . '/' . $this->generatePath();
            $name = 'o_' . $this->generateFilename();
            $absPath = $this->config['base_path'] . '/' . $relativePath;

            // 保存到数据库
            $uploadFile = new UploadFile();
            $uploadFile->name = $name;
            $uploadFile->real_name = $file->getClientOriginalName();
            $uploadFile->path = $relativePath;
            $uploadFile->type = $file->getMimeType();
            $uploadFile->ext = $file->getClientOriginalExtension();
            $uploadFile->real_ext = $file->getClientOriginalExtension();
            $uploadFile->file_size = $file->getClientSize();
            $uploadFile->uploader = $this->user->id;

            if ($file->move($absPath, $name . '.' .$uploadFile->ext)) {
                if ($uploadFile->save()) {
                    $url = $this->config['base_url'] . '/' . $relativePath . '/' . $name . '.' .$uploadFile->ext;

                    $thumbnails = [];
                    // 制作缩略图
                    if (@ $this->config['thumbnails']) {
                        $img = Image::make($absPath . '/' . $name . '.' . $uploadFile->ext);
                        foreach ($this->config['thumbnails'] as $thumbnail) {
                            // 备份一份
                            $img->backup();

                            if (!$img->resize($thumbnail['width'], $thumbnail['height'])) {
                                return $this->abort(self::STATUS_MAKE_THUMBNAIL_ERROR);
                            }

                            $newFileAbsPath = $this->config['base_path'] . '/' . $relativePath . '/' . $thumbnail['width'] . 'x' . $thumbnail['height'] . '_' . substr($name, 2) . '.' . $uploadFile->ext;

                            // 保存
                            if (!$img->save($newFileAbsPath)) {
                                return $this->abort(self::STATUS_THUMBNAIL_DISK_SAVE_ERROR);
                            }

                            $thumbnails[] = $this->config['base_url'] . '/' . $uploadFile->path . '/' . $thumbnail['width'] . 'x' . $thumbnail['height'] . '_' . substr($uploadFile->name, 2) . '.' . $uploadFile->ext;

                            // 复原
                            $img->reset();
                        }
                    }

                    return $this->success(['url' => $url, 'id' => $uploadFile->id, 'thumbnails' => $thumbnails]);
                } else {
                    $this->abort(self::STATUS_ORIGIN_DB_SAVE_ERROR);
                }
            } else {
                return $this->abort(self::STATUS_ORIGIN_DISK_SAVE_ERROR);
            }
        } else {
            return $this->abort(self::STATUS_FILE_INVALID);
        }
    }

    private function abort($status)
    {
        return response()
            ->json(['status' => $status, 'msg' => static::$messages[$status]])
            ->header('Content-Type', 'text/html');
    }

    private function isValid($file)
    {
        $config = $this->config;
        $fileSize = $file->getClientSize();
        if (@ $config['min_file_size'] && $fileSize < $config['min_file_size']) {
            $this->status = self::STATUS_FILE_TOO_SMALL;
            return false;
        }

        if (@ $config['max_file_size'] && $fileSize > $config['max_file_size']) {
            $this->status = self::STATUS_FILE_TOO_LARGE;
            return false;
        }

        if (!in_array($file->getMimeType(), ['image/png', 'image/jpeg', 'image/gif'])) {
            $this->status = self::STATUS_FILE_TYPE_ERROR;
            return false;
        }

        return true;
    }

    private function generatePath()
    {
        return date('Y/m/d');
    }

    private function generateFilename()
    {
        return str_random(32);
    }

    private function success($data)
    {
        return response()
            ->json(['status' => 200, 'data' => $data])
            ->header('Content-Type', 'text/html');
    }
    
    public function getCrop(Request $request) {
        $this->config = config('admin.image.operations.crop.' . $this->type);
        if (empty($this->config)) {
            $this->status = self::STATUS_UNKNOWN_TYPE;
            return $this->abort($this->status);
        }

        $inputs = $request->only(['x', 'y', 'w', 'h', 'id', 'type']);

        $originUploadFile = UploadFile::findOrFail($inputs['id']);

        if (!$originUploadFile) {
            return $this->abort(self::STATUS_NO_SUCH_FILE_HAVE_UPLOADED);
        }

        $relativePath = $originUploadFile->path . '/' .$originUploadFile->name . '.' .$originUploadFile->ext;
        $absPath = $this->config['origin_path'] . '/' . $relativePath;

        try {
            $img = Image::make($absPath);
        } catch (\Exception $e) {
            return $this->abort(self::STATUS_UPLOADED_FILE_NOT_FOUND);
        }

        if ($img->crop(intval($inputs['w']), intval($inputs['h']), intval($inputs['x']), intval($inputs['y']))) {
            $newRelPath = $originUploadFile->path . '/' . substr($originUploadFile->name, 2) . '.' .$originUploadFile->ext;
            $newAbsPath = $this->config['base_path'] . '/' . $newRelPath;

            if ($img->save($newAbsPath)) {
                $url = $this->config['base_url'] . '/' . $newRelPath;

                $thumbnails = [];
                // 制作缩略图
                if (@ $this->config['thumbnails']) {
                    foreach ($this->config['thumbnails'] as $thumbnail) {
                        // 备份一份
                        $img->backup();

                        if (!$img->resize($thumbnail['width'], $thumbnail['height'])) {
                            return $this->abort(self::STATUS_MAKE_THUMBNAIL_ERROR);
                        }

                        $newThumbnailAbsPath = $this->config['base_path'] . '/' . $originUploadFile->path . '/' . $thumbnail['width'] . 'x' . $thumbnail['height'] . '_' . substr($originUploadFile->name, 2) . '.' . $originUploadFile->ext;

                        // 保存
                        if (!$img->save($newThumbnailAbsPath)) {
                            return $this->abort(self::STATUS_THUMBNAIL_DISK_SAVE_ERROR);
                        }

                        $thumbnails[] = $this->config['base_url'] . '/' . $originUploadFile->path . '/' . $thumbnail['width'] . 'x' . $thumbnail['height'] . '_' . substr($originUploadFile->name, 2) . '.' . $originUploadFile->ext;

                        // 复原
                        $img->reset();
                    }
                }

                return $this->success(['url' => $url, 'thumbnails' => $thumbnails]);
            } else {
                return $this->abort(self::STATUS_ORIGIN_DISK_SAVE_ERROR);
            }
        } else {
            $this->abort(self::STATUS_FAIL_TO_CROP_FILE);
        }
    }
}
