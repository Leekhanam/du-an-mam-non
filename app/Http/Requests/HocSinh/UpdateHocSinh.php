<?php

namespace App\Http\Requests\HocSinh;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
class UpdateHocSinh extends FormRequest
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
        $fields = $this->all();
        $year_now = Carbon::now()->subYear();
        $rules = [
            'ten' => 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40',
            'ngay_sinh' => 'required|date|after:2012-01-01|before_or_equal:' . $year_now,
            'gioi_tinh' => 'required|boolean',
            'dan_toc' => 'required|numeric',

            'ho_khau_thuong_tru_matp' => 'required|numeric',
            'ho_khau_thuong_tru_maqh' => 'required|numeric',
            'ho_khau_thuong_tru_xaid' => 'required|numeric',
            'ho_khau_thuong_tru_so_nha' => 'required',

            'noi_o_hien_tai_matp' => 'required|numeric',
            'noi_o_hien_tai_maqh' => 'required|numeric',
            'noi_o_hien_tai_xaid' => 'required|numeric',
            'noi_o_hien_tai_so_nha' => 'required',

    
        ];
        if(($fields['ten_thuong_goi'] != "" || $fields['ten_thuong_goi'] != null)){
            $rules['ten_thuong_goi'] = 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40';
        }
        if(($fields['ten_cha'] == "" || $fields['ten_cha'] == null) &&
           ($fields['ten_me'] == "" || $fields['ten_me'] == null))
        {
            
            $rules['ten_nguoi_giam_ho'] = 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40';
            $rules['dien_thoai_nguoi_giam_ho'] = 'required|numeric|digits_between:10,12';
            $rules['cmtnd_nguoi_giam_ho'] = 'required|numeric';

        }elseif(($fields['ten_cha'] == "" || $fields['ten_cha'] == null)){
           
            $rules['ten_me'] = 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40';
            $rules['dien_thoai_me'] = 'required|digits_between:10,12|numeric';
            $rules['cmtnd_me'] = 'required|numeric';

        }elseif(($fields['ten_me'] == "" || $fields['ten_me'] == null)){
           
            $rules['ten_cha'] = 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40';
            $rules['dien_thoai_cha'] = 'required|numeric|digits_between:10,12';
            $rules['cmtnd_cha'] = 'required|numeric';

        }else {
            
            $rules['ten_cha'] = 'regex:/^[\pL\s\-]+$/u|min:6|max:40';
            $rules['ten_me'] = 'regex:/^[\pL\s\-]+$/u|min:6|max:40';
            
            $rules['dien_thoai_cha'] = 'numeric|digits_between:10,12';
            $rules['dien_thoai_me'] = 'numeric|digits_between:10,12';
            
            $rules['cmtnd_cha'] = 'required|numeric';
            $rules['cmtnd_me'] = 'required|numeric';
            
            if(($fields['ten_nguoi_giam_ho'] != "" || $fields['ten_nguoi_giam_ho'] != null)){
                $rules['ten_nguoi_giam_ho'] = 'regex:/^[\pL\s\-]+$/u|min:6|max:40';
                $rules['dien_thoai_nguoi_giam_ho'] = 'numeric|digits_between:10,12';
                $rules['cmtnd_nguoi_giam_ho'] = 'numeric';
            }
        }

       return $rules;
    }

    public function messages(){
        return [
            'required' => 'Vui lòng nhập trường này',
            'ten.regex' => 'Vui lòng nhập đúng tên',
            'ten_cha.regex' => 'Vui lòng nhập đúng tên',
            'ten_me.regex' => 'Vui lòng nhập đúng tên',
            'ten_nguoi_giam_ho.regex' => 'Vui lòng nhập đúng tên',
            'numeric' => 'Vui lòng nhập dữ liệu hợp lệ',
            'min' => 'Vui lòng điền trường này trên 6 ký tự',
            'max' => 'Vui lòng điền trường này dưới 40 ký tự',

            'dien_thoai_cha.regex' => 'Vui lòng nhập số điện thoại hợp lệ',
            'dien_thoai_me.regex' => 'Vui lòng nhập số điện thoại hợp lệ',
            'dien_thoai_nguoi_giam_ho.regex' => 'Vui lòng nhập số điện thoại hợp lệ',

            'date' => 'Vui lòng nhập dữ liệu hợp lệ',
            'dien_thoai_dang_ki.required' => 'Vui lòng nhập số điện thoại',
            'dien_thoai_dang_ki.regex' => 'Vui lòng nhập số điện thoại hợp lệ',
            'dien_thoai_dang_ki.unique' => 'Số điện thoại đã tồn tại',

            'email_dang_ky.required' => 'Vui lòng điền Email!',
            'email_dang_ky.email' => 'Email không hợp lệ!',
            'email_dang_ky.unique' => 'Email đã tồn tại!',

            'ten_thuong_goi.regex' => 'Vui lòng nhập đúng tên',
        ];
    }
    public function attributes()
    {
        return [
            'ten' => 'Họ và tên bé',
            'gioi_tinh' => 'Giới tính',
            'ngay_sinh' => 'Ngày sinh',
            'dan_toc' => 'Dân tộc',
            'ten_cha' => 'Họ tên cha',
            'cmtnd_cha' => 'Chứng minh thư',
            'dien_thoai_cha' => 'Điện thoại',
            'ten_me' => 'Họ tên mẹ',
            'cmtnd_me' => 'Chứng minh thư',
            'dien_thoai_me' => 'Điện thoại',
            'ho_khau_thuong_tru_matp' => 'Thành phố',
            'ho_khau_thuong_tru_maqh' => 'Quận huyện',
            'ho_khau_thuong_tru_xaid' => 'Xã phường',
            'ho_khau_thuong_tru_so_nha' => 'Thôn/Số nhà',
            'noi_o_hien_tai_matp' => 'Thành phố',
            'noi_o_hien_tai_maqh' => 'Quận huyện',
            'noi_o_hien_tai_xaid' => 'Xã phường',
            'noi_o_hien_tai_so_nha' => 'Thôn/Số nhà',
            'ten_nguoi_giam_ho' => 'Họ tên người giám hộ',
            'cmtnd_nguoi_giam_ho' => 'Chứng minh thư',
            'dien_thoai_nguoi_giam_ho' => 'Điện thoại',
        ];
    }
}
