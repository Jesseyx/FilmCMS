<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PermissionGroupStoreAndUpdate extends Request
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
            'name' => 'required|unique:permission_groups,name,' . $this->route('permission_group'),
            'order' => 'integer',
            'status' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '分组名称不能为空',
            'name.unique' => '分组名称已存在',
            'order.integer' => '请填写正确的排序值',
            'status' => '请选择状态'
        ];
    }
}
