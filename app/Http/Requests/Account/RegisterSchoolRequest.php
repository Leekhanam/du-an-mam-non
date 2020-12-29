<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterSchoolRequest extends FormRequest
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
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'phone_number' => 'required|digits:10|unique:users,phone_number',
            'email' => 'required|email|unique:users,email'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng điền Họ và Tên',
            'name.regex' => 'Vui lòng điền Họ và Tên hợp lệ',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'phone_number.digits' => 'Vui lòng nhập số có độ dài 10 ký tự',  
            'phone_number.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Vui lòng điền Email!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã được đăng ký!'
        ];
    }
}
