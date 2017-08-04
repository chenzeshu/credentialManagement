<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required',
            'password' => 'required | confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'必须填写姓名',
            'email.required'=>'必须填写邮箱',
            'email.email'=>'邮箱格式错误',
            'phone.required'=>'必须填写手机',
            'password.required'=>'必须填写密码',
            'password_confirmation.required'=>'必须再次填写密码'
        ];
    }
}
