<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PassswordResetRequest extends Request
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
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'=>'必须填写原密码',
            'password.required'=>'必须填写新密码',
            'password.confirmed'=>'新密码不一致',
            'password.min'=>'新密码长度不能小于6位',
            'password_confirmation.required'=>'两次输入的新密码不一致',
        ];
    }
}
