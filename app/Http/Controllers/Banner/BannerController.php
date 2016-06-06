<?php

namespace App\Http\Controllers\Banner;

use App\BannerBlock;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    function __construct()
    {
        $user = Auth::user();
        $this->user_id = $user['id'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\BannerStoreAndUpdate $request)
    {
        //
        $inputs = $request->all();
        $banner = new BannerBlock();

        $banner->title = $inputs['title'];
        $banner->sub_title = $inputs['sub_title'];
        $banner->img_url = parse_url($inputs['img_url'], PHP_URL_PATH);
        $banner->link_path = $inputs['link_path'];
        $banner->description = $inputs['description'];
        if (isset($inputs['is_ad'])) {
            $banner->is_ad = intval($inputs['is_ad']);
        }
        $banner->status = $inputs['status'];
        if ($inputs['source_id']) {
            $banner->source_id = $inputs['source_id'];
        }
        $banner->resource_type = $inputs['resource_type'];
        $banner->platform = $inputs['platform'];
        $banner->audit_user_id = $this->user_id;
        $banner->order = $inputs['order'];

        $banner->save();

        return redirect('/banner');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function ajaxEdit(Request $request)
    {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'id' => 'required|integer',
            'order' => 'integer',
            'status' => 'integer'
        ], [
            'id.required' => 'id 不能为空',
            'id.integer' => 'id 格式不正确',
            'order.integer' => '排序格式不正确',
            'status.integer' => '状态不正确',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['status' => 400, 'msg' => $messages]);
        }

        $info = [];
        $banner = BannerBlock::findOrFail($inputs['id']);

        if (isset($inputs['order'])) {
            $info['order'] = intval($inputs['order']);
        }

        if (isset($inputs['status']) && in_array($inputs['status'], ['-1', '0', '1'])) {
            $status = intval($inputs['status']);

            if ($banner->status !== $status) {
                $info['status'] = $status;
                // 设置上下架时间
                if ($status === 1) {
                    $inputs['up_time'] = date('Y-m-d H:i:s');
                } else if ($status === -1) {
                    $info['down_time'] = date('Y-m-d H:i:s');
                }
            }
        }

        if (isset($inputs['title'])) {
            $info['title'] = $inputs['title'];
        }

        if (isset($inputs['description'])) {
            $info['description'] = $inputs['description'];
        }

        if (!empty($info)) {
            $info['audit_userid'] = $this->user_id;
            $banner->update($info);
        }

        return response()->json(['status' => 200, 'data' => $banner]);
    }
}
