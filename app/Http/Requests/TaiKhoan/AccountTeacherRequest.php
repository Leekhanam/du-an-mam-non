<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class AccountTeacherRequest extends FormRequest
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
            'email' => 'required|email|unique:users,id,email',
            'ten' => 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40',
            'ngay_sinh' => 'required',
            'dan_toc' => 'required',
            'dien_thoai'=>'required|digits:10|unique:users,id,phone_number',
            'chuyen_mon'=>'required|regex:/^[\pL\s\-]+$/u',
            'trinh_do'=>'required|regex:/^[\pL\s\-]+$/u',
            'noi_dao_tao'=>'required|regex:/^[\pL\s\-]+$/u',
            'nam_tot_nghiep'=>'required|numeric',
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
            'min' => ':attribute ít nhất 6 ký tự',
            'ten.max' => 'Họ tên không được vượt quá 40 ký tự',   
            'email.email' => 'Email không hợp lệ!',
            'email.unique' => 'Email đã được đăng ký!',
            'required' => ' :attribute không được để trống!',
            'integer' => ' :attribute phải là số nguyên',
            'min' => ' :attribute ít nhất 11 số',
            'numeric' => ' :attribute phải là số',
            'dien_thoai.digit'=>'Vui lòng nhập số có độ dài 10 ký tự !',
            'dien_thoai.unique'=>'Số điện thoại đã tồn tại',
            
        ];
    }
    
    public function attributes()
    {
        return [
            'ten' => 'Họ và tên',
            'ngay_sinh' => 'Ngày sinh ',
            'dan_toc' => 'Dân tộc',
            'dien_thoai' => 'SĐT ',
            'trinh_do'=>'Trình độ',
            'chuyen_mon'=>'Chuyên môn',
            'noi_dao_tao'=>'Nơi đào tạo',
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
