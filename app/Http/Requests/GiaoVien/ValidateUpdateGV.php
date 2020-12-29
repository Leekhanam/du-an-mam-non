<?php

namespace App\Http\Requests\GiaoVien;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUpdateGV extends FormRequest
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
        
        $data = $this->all();
        $getCheck = [];
        $getCheck['ho_khau_thuong_tru_matp'] = 'required|';
        $getCheck['ho_khau_thuong_tru_maqh'] = 'required|';
        $getCheck['ho_khau_thuong_tru_xaid'] = 'required|';
        $getCheck['ho_khau_thuong_tru_so_nha'] = 'required|';

        $getCheck['noi_o_hien_tai_matp'] = 'required|';
        $getCheck['noi_o_hien_tai_tru_maqh'] = 'required|';
        $getCheck['noi_o_hien_tai_tru_xaid'] = 'required|';
        $getCheck['noi_o_hien_tai_tru_so_nha'] = 'required|';
        
        foreach ($data as $item => $value) {
            if ($value == null) {
                $getCheck[$item] = 'required';
            } else {
                $getCheck[$item] = 'required';
            }
        }
        $getCheck['dien_thoai'] = 'regex:/(0)[0-9]{9}/';
        return $getCheck;
    }
    public function messages()
    {
        return [
            'required' => 'Không được để trống',
            'regex' => 'Độ dài 11'
            
        ];
    }


    
}
