<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:user',
            'email' => 'required|email|unique:user',
            'fullname' => 'required',
            'password' => 'required|min:6',
            'repassword' => 'same:password'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Tên đăng nhập không được để trống',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email chưa hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'fullname.required' => 'Tên người dùng không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'repassword.same' => 'Mật khẩu chưa khớp'
        ];
    }
}
