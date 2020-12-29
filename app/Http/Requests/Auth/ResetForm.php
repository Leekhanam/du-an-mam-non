<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetForm extends FormRequest
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
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages(){
        return [
            'password.required' => 'Vui lòng điền Mật khẩu!',
            'password.min' => 'Mật khẩu trên 8 ký tự',
            'password.confirmed' => 'Mật khẩu không khớp',

            'password_confirmation.required' => 'Vui lòng điền Mật khẩu!',
            'password_confirmation.same' => 'Mật khẩu không khớp'
        ];
    }
}
