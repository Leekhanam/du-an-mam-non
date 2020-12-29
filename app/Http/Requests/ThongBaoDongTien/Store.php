<?php

namespace App\Http\Requests\ThongBaoDongTien;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
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
        $now = Carbon::now();
        if ($this->trang_thai_thong_bao == 1) {
            return [
                'ngay_bat_dau' => 'required|date|before_or_equal:ngay_ket_thuc|after_or_equal:'.$now->toDateString(),
                'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
            ];
        }else{
            return [];
        }
        
    }
}
