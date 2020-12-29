<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class AccountAdminRequest extends FormRequest
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

            'name'=>'required|regex:/^[\pL\s\-]+$/u|min:6|max:40',
            'username'=>'required|unique:users,id,username',
            'email' => 'required|email|unique:users,id,email',
            'phone_number'=>'required|digits:10|unique:users,id,phone_number',
        ];

    }

    public function messages(){
        return [
            'name.required'=>'Vui lòng điền họ tên!',
            'name.regex'=>'Tên không chứa số và ký tự đặc biệt',
            'name.min' => 'Họ tên ít nhất 6 ký tự',  
            'name.max' => 'Họ tên không được vượt quá 40 ký tự', 
            'email.required' => 'Vui lòng điền Email!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã được đăng ký!',
            'username.required'=>'Vui lòng điền UserName! ',
            'username.unique'=>'UserName đã tồn tại !',
            'phone_number.required'=>'Vui lòng điền số điện thoại!',
            'phone_number.digits'=>'Vui lòng nhập số điện thoại có độ dài 10 ký tự !',
            'phone_number.unique'=>'Số điện thoại đã tồn tại',
            
        ];
    }
}
