<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BannerStoreAndUpdate extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'title' => 'required',
            'img_url' => 'required',
            'link_path' => 'required_if:is_ad,1',
            'status' => 'required|integer',
            'source_id' => 'required_if:resource_type,1,2',
            'resource_type' => 'required|integer',
            'platform' => 'required',
            'order' => 'sometimes|integer',
        ];
    }

    public function messages()
    {
        return [
            //
            'title.required' => '标题不能为空',
            'img_url.required' => '图片不能为空',
            'link_path.required_if' => '勾选了广告后跳转 url 不能为空',
            'status.required' => '状态不能为空',
            'status.integer' => '状态必须为整数',
            'source_id.required_if' => '资源类型为电影或游戏时id不能为空',
            'resource_type.required' => '资源类型不能为空',
            'resource_type.integer' => '资源类型必须选择',
            'platform.required' => '平台不能为空',
            'order.integer' => '排序必须为整数',
        ];
    }
}
