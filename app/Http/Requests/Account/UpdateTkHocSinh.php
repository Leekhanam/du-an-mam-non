<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTkHocSinh extends FormRequest
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
            'email'        => 'required|email|unique:users,email,' . $this->id,
            'phone_number' => 'required|regex:/^0[0-9]{9}$/|not_regex:/[a-z]/|unique:users,phone_number,' . $this->id,
        ];
    }

    public function messages(){
        return [
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'phone_number.regex' => 'Vui lòng đúng định dạng số điện thoại',  
            'phone_number.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Vui lòng điền Email!',
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã được đăng ký!'
        ];
    }
}
