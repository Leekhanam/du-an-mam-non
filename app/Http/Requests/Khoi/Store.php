<?php

namespace App\Http\Requests\Khoi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
        // dd($this->ten_lop);
        return [
            'ten_khoi' =>  [
                'required', 
                'string',
                'between:5,30',
                Rule::unique('khoi')
                       ->where('nam_hoc_id', $this->nam_hoc_id)
            ],
            'do_tuoi' => [
                'required',
                'integer',
                'between:1,5', 
                Rule::unique('khoi')
                       ->where('nam_hoc_id', $this->nam_hoc_id),
                
            ]
        ];
    }

    public function messages(){
        return [
            'ten_khoi.required' => 'Tên khối không được để trống',
            'ten_khoi.unique' => 'Tên khối đã tồn tại',
            'ten_khoi.between' => 'Tên khối phải có độ dài từ 5 đến 30 kí tự',
            'do_tuoi.required' => 'Độ tuổi không được để trống',
            'do_tuoi.unique' => 'Độ tuổi đã tồn tại',
            'do_tuoi.between' => 'Độ tuổi không hợp lệ',



        ];
    }
}
