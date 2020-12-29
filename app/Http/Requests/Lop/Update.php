<?php

namespace App\Http\Requests\Lop;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Khoi;
use App\Models\Lop;

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
        Validator::extend('custom_rule', function ($attribute, $value) {
            $dataKhoi = Lop::find($this->lop_id)->Khoi;
            $query = $dataKhoi->NamHoc->Khoi;
            foreach ($query as $key => $value) {
               $count = $value->LopHoc->where('ten_lop',$this->ten_lop)->where('id','!=',$this->lop_id)->count();
               if($count>0){
                   return false;
               }
            }
            return true;
        });
        
        // dd($this->ten_lop);
        return [
            'ten_lop' => 'required|custom_rule|between:5,30',
        ];
    }
    public function messages()
    {
        return [
            'ten_lop.required' => 'Tên lớp không được để trống',
            'ten_lop.custom_rule' => 'Tên lớp đã tồn tại',
            'ten_lop.between' => 'Tên lớp phải có độ dài từ 5 đến 30 ký tự',
        ];
    }
}
