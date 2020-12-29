<?php

namespace App\Http\Requests\DotThu;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'ten_dot_thu'=>'required|string|between:5,30'
        ];
    }

    public function messages(){
        return [
            'ten_dot_thu.required' => 'Tên đợt không được để trống',
            'ten_dot_thu.between' => 'Tên đợt phải có độ dài từ 5 đến 30 kí tự',
        ];
    }
}
