<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class AccountStudentRequest extends FormRequest
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
            'email_dang_ky' => 'required|email|unique:users,id,email',
            'ten' => 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40',
            'ngay_sinh' => 'required',
            'dan_toc' => 'required',
            'dien_thoai_dang_ki'=>'required|min:11|numeric',
            'noi_sinh'=>'required',
            'ten_thuong_goi'=>'required',
            'ten_cha'=>'regex:/^[\pL\s\-]+$/u|min:6|max:40',
            'ten_me'=>'regex:/^[\pL\s\-]+$/u|min:6|max:40',
            'cmtnd_cha'=>'min:9|numeric',
            'cmtnd_me'=>'min:9|numeric',
            'dien_thoai_cha'=>'min:11|numeric',
            'dien_thoai_me'=>'min:11|numeric',
            'doi_tuong_chinh_sach_id'=>'required',
            'ngay_vao_truong'=>'required',
            'ho_khau_thuong_tru_matp'=>'required',
            'ho_khau_thuong_tru_maqh'=>'required',
            'ho_khau_thuong_tru_xaid'=>'required',
            'noi_o_hien_tai_matp'=>'required',
            'noi_o_hien_tai_maqh'=>'required',
            'noi_o_hien_tai_xaid'=>'required',
            'noi_o_hien_tai_so_nha'=>'required',
            'ho_khau_thuong_tru_so_nha'=>'required',
        ];
    }

    public function messages(){
        return [
            'regex'=>':attribute không chứa số và ký tự đặc biệt',
            'name.min' => 'Họ tên ít nhất 6 ký tự',  
            'name.max' => 'Họ tên không được vượt quá 40 ký tự', 
            'ten_cha.min' => 'Họ tên ít nhất 6 ký tự',  
            'ten_cha.max' => 'Họ tên không được vượt quá 40 ký tự', 
            'ten_me.min' => 'Họ tên ít nhất 6 ký tự',  
            'ten_me.max' => 'Họ tên không được vượt quá 40 ký tự', 
            'email_dang_ky.email' => 'Email không hợp lệ!',
            'email_dang_ky.unique' => 'Email đã được đăng ký!',
            'required' => ' :attribute không được để trống!',
            'integer' => ' :attribute phải là số nguyên!',
            'cmtnd_cha.min'=>'CMT/CCCD phải ít nhất 9 số!',
            'cmtnd_me.min'=>'CMT/CCCD phải ít nhất 9 số!',
            'min' => ' :attribute ít nhất 11 số',
            'numeric' => ' :attribute phải là số',
        ];
    }
    
    public function attributes()
    {
        return [
            'email'=>'Email',
            'ma_hoc_sinh'=>'Mã học sinh',
            'ten_thuong_goi'=>'Tên thường gọi',
            'ten' => 'Họ và tên',
            'ngay_sinh' => 'Ngày sinh ',
            'dan_toc' => 'Dân tộc',
            'dien_thoai_dang_ki' => 'SĐT ',
            'cmtnd_cha'=>'Số CMND/CCCD',
            'cmtnd_me'=>'Số CMND/CCCD',
            'ten_cha'=>'Tên cha',
            'ten_me'=>'Tên cha',
            'dien_thoai_cha'=>'SĐT Cha',
            'dien_thoai_me'=>'SĐT Mẹ',
            'doi_tuong_chinh_sach_id'=>'Đối tượng chính sách',
            'noi_sinh'=>'Nơi sinh ',
            'nam_tot_nghiep'=>'Năm tốt nghiệp',
            'ho_khau_thuong_tru_matp'=>'Tỉnh/Thành phố',
            'ho_khau_thuong_tru_maqh'=>'Quận/Huyện',
            'ho_khau_thuong_tru_xaid'=>'Phường/Xã',
            'ho_khau_thuong_tru_so_nha'=>'Số nhà/Thôn',
            'noi_o_hien_tai_matp'=>'Tỉnh/Thành phố',
            'noi_o_hien_tai_maqh'=>'Quận/Huyện',
            'noi_o_hien_tai_xaid'=>'Phường/Xã',
            'noi_o_hien_tai_so_nha'=>'Số nhà/Thôn',
        ];
    }
}
