<?php

namespace App\Http\Requests\ThongTinTruong;

use Illuminate\Foundation\Http\FormRequest;

class storeThongTinTruong extends FormRequest
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
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'hotline' => 'required|regex:/^0[0-9]{9}$/|not_regex:/[a-z]/',
            'email' => 'required|email',
        ];
    }
    public function messages()
    {
        return [
            'required' => '**Không được để trống',
            'name.regex' => '**Hãy điền chuẩn tên trường',
            'hotline.regex' => '**Hãy điền chuẩn hotline',
            'email' => '**Hãy điền chuẩn định dạng email',
        ];
    }
}
