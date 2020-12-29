<?php

namespace App\Http\Requests\DangKiNhapHoc;

use Illuminate\Foundation\Http\FormRequest;

class EditNhapHoc extends FormRequest
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
     $rules = [      
            'ten' => 'required',
            'gioi_tinh' => 'required',
            'ngay_sinh' => 'required',
            'dan_toc' => 'required',
            'dien_thoai_dang_ki' => 'required|min:11|numeric|unique:users,phone_number',
            'email_dang_ky' => 'required|email:rfc,dns|unique:users,email',
            'ho_khau_thuong_tru_matp' => 'required',
            'ho_khau_thuong_tru_maqh' => 'required',
            'ho_khau_thuong_tru_xaid' => 'required',
            'ho_khau_thuong_tru_so_nha' => 'required',
            'noi_o_hien_tai_matp' => 'required',
            'noi_o_hien_tai_maqh' => 'required',
            'noi_o_hien_tai_xaid' => 'required',
            'noi_o_hien_tai_so_nha' => 'required',
        ];

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
             $rules['ten_nguoi_giam_ho'] = 'regex:/^[\pL\s\-]+$/u|min:6|max:40';
 
             $rules['dien_thoai_cha'] = 'numeric|digits_between:10,12';
             $rules['dien_thoai_me'] = 'numeric|digits_between:10,12';
             $rules['dien_thoai_nguoi_giam_ho'] = 'numeric|digits_between:10,12';
 
             $rules['cmtnd_cha'] = 'required|numeric';
             $rules['cmtnd_me'] = 'required|numeric';
             $rules['cmtnd_nguoi_giam_ho'] = 'required|numeric';
         }
 
         return $rules;
    }


    public function messages()
    {
        return [
            'required' => ' :attribute không được để trống',
            'integer' => ' :attribute phải là số nguyên',

            'ten.min' => 'Tên ít nhất 6 ký tự',
            'ten_cha.min' => 'Tên ít nhất 6 ký tự',
            'ten_me.min' => 'Tên ít nhất 6 ký tự',
            'ten_nguoi_giam_ho.min' => 'Tên ít nhất 6 ký tự',

            'ten.max' => 'Tên nhiều nhất 40 ký tự',
            'ten_cha.max' => 'Tên nhiều nhất 40 ký tự',
            'ten_me.max' => 'Tên nhiều nhất 40 ký tự',
            'ten_nguoi_giam_ho.max' => 'Tên nhiều nhất 40 ký tự',
            
            'digits_between' => ' :attribute 10 hoặc 12 số',
            'boolean' => ' :attribute chưa hợp lệ',
            'date' => ' :attribute chưa đúng định dạng',
            'email' => ' :attribute nhập đúng định dạng email',
            'numeric' => ' :attribute phải là số',
            'unique' => ' :attribute đã tồn tại',
            'regex' => ' :attribute dữ liệu chưa hợp lệ',
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
            'dien_thoai_dang_ki' => 'Điện thoại đăng kí',
            'email_dang_ky' => 'Email',
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
