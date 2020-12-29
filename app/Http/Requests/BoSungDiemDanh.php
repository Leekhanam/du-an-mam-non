<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoSungDiemDanh extends FormRequest
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
            'ngay_diem_danh' => 'required|before_or_equal:today'
        ];
    }

    public function messages()
    {
        return [
            'ngay_diem_danh.required' => 'Hãy nhập ngày',
            'ngay_diem_danh.before_or_equal' => 'Chỉ có thể bổ sung trước ngày hôm nay'
        ];
    }
}
