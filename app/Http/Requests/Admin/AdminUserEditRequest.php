<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserEditRequest extends FormRequest
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
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => '',
            'repassword' => 'same:password'
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Tên người dùng không được để trống',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email chưa hợp lệ',
            'repassword.same' => 'Mật khẩu chưa khớp'
        ];
    }
}
