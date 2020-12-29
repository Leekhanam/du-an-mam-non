<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // if(\Request::ip() == '127.0.0.1'){
        //     return false;
        // }
        //     return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users'
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Vui lòng điền Email!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã được đăng ký!'
        ];
    }
}
