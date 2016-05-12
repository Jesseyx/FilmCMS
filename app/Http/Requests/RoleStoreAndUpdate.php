<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoleStoreAndUpdate extends Request
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
            'name' => 'required|unique:roles,name,' . $this->route('role'),
            'order' => 'integer',
            'status' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '角色不能为空',
            'name.unique' => '角色已存在',
            'order.integer' => '排序值必须为数字',
            'status.integer' => '状态必须为数字',
        ];
    }
}
