<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PermissionStoreAndUpdate extends Request
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
            'name' => 'required|unique:permissions,name,' . $this->route('permission'),
            'group_id' => 'required|integer',
            'location' => 'required',
            'status' => 'integer',
            'order' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '权限名称不能为空',
            'name.unique' => '权限名称已存在',
            'group_id.required' => '权限分组不能为空',
            'group_id.integer' => '权限分组格式不正确',
            'location.required' => '访问方法不能为空',
            'status.integer' => '状态格式不正确',
            'order.integer' => '排序格式不正确',
        ];
    }
}
