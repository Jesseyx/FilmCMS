<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserEditRequest extends Request
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
            'cellphone' => ['required', 'regex:"^1\d{10}$"'],
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'cellphone.required' => '手机号不能为空',
            'cellphone.regex' => '请填写正确的手机号码',
            'email.required' => '邮箱不能为空',
            'email.email' => '请填写正确的电子邮箱',
        ];
    }
}
