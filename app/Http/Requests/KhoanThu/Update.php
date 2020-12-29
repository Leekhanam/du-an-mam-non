<?php

namespace App\Http\Requests\KhoanThu;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
        $dataCheck = [];
        foreach ($this->all() as $key => $value) {
            if($key == 'pham_vi_thu'){
                // dd($value);
                if ($value==1) {
                    $dataCheck['id_khoi_thu']='required';
                }elseif($value == 2){
                    $dataCheck['id_lop_thu']='required';
                }
            }
            $dataCheck[$key]='required';  
            if ($key == 'ten_khoan_thu') {
                $dataCheck['ten_khoan_thu']='required|string|between:5,60';
                $dataCheck['mien_giam']='required|integer|between:0,100';
            }

            if ($key == 'don_vi_tinh') {
                $dataCheck['don_vi_tinh']='required|integer|between:0,3';
            }     
        }
        
        $dataCheck['muc_thu']='required|integer|min:0';
          
        
        return $dataCheck;
    }

    public function messages(){
        return [
            'ten_khoan_thu.required' => 'Tên khoản thu không được để trống',
            'ten_khoan_thu.string' => 'Tên khoản thu phải là chữ',
            'ten_khoan_thu.between' => 'Tên khoản thu phải từ 5 đến 60 ký tự',

            'don_vi_tinh.required' => 'Đơn vị tính không được để trống',
            'don_vi_tinh.between' => 'Vui lòng nhập đúng đơn vị tính',

            'mien_giam.between' => 'Số miễn giảm phải từ 0 đến 100',
            
            'muc_thu.integer' => 'Mức thu phải là số',
            'muc_thu.min' => 'Mức thu phải lớn hơn 0',
            'muc_thu.required' => 'Mức thu không được để trống',

            'id_lop_thu.required' => 'Lớp thu không được để trống',
            'id_khoi_thu.required' => 'Khối không được để trống',


        ];
    }
}
