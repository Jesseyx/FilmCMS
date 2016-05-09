<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserStoreAndUpdate extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 服务 - 验证
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
            // 这个地方绑定的路由的是 user/{ user }
            'username' => 'required|min:6|unique:users,username,'.$this->route('user'),
            'name' => 'required',
            'avatar' => 'url',
            'roles' => 'required',
            'cellphone' => 'digits:11',
            'email' => 'email',
            'password' => 'min:6',
            'status' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'username.min' => '账号不能小于6个字符',
            'username.unique' => '用户名已存在',
            'name.required' => '必须填写真实姓名',
            'avatar.url' => '头像 URL 非法',
            'roles.required' => '必须选择角色',
            'cellphone.digits' => '手机号码不正确',
            'email.email' => '电子邮箱不合法',
            'password.min' => '密码不能小于6个字符',
            'status.integer' => '请选择状态',
        ];
    }
}
