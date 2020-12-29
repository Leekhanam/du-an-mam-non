<?php

namespace App\Http\Requests\GiaoVien;

use Illuminate\Foundation\Http\FormRequest;

class StoreGiaoVien extends FormRequest
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
        unset($data['_token']);
        unset($data['lop_id']);
        unset($data['khoi']);
  
        return [
            'ten'   => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|unique:users,email|email',
            'ngay_sinh'  => 'required|date',
            'gioi_tinh'  => 'required|boolean',
            'dan_toc'    => 'required|numeric',
            'dien_thoai' => 'required|regex:/^0[0-9]{9}$/|not_regex:/[a-z]/|unique:giao_vien,dien_thoai',

            'ho_khau_thuong_tru_matp'  => 'required|numeric',
            'ho_khau_thuong_tru_maqh'  => 'required|numeric',
            'ho_khau_thuong_tru_xaid'  => 'required|numeric',
            'ho_khau_thuong_tru_so_nha'  => 'required',
            'noi_o_hien_tai_matp'  => 'required|numeric',
            'noi_o_hien_tai_maqh'  => 'required|numeric',
            'noi_o_hien_tai_xaid'  => 'required|numeric',
            'noi_o_hien_tai_so_nha'  => 'required',

            'trinh_do'  => 'required',
            'chuyen_mon'  => 'required',
            'noi_dao_tao'  => 'required',
            'nam_tot_nghiep'  => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),

            'so_cmtnd' =>'required|numeric',
            'ngay_cap_cmtnd' => 'required|date',
            'noi_cap_cmtnd_matp' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ' :attribute không được để trống',
            'boolean' => ' :attribute chưa hợp lệ',
            'date' => ' :attribute chưa đúng định dạng',
            'email' => ' :attribute hãy nhập đúng định dạng email',
            'numeric' => ' :attribute phải là số',
            'unique' => ' :attribute đã tồn tại',
            'regex' => ' :attribute không hợp lệ',
            'digits' => ' :attribute không hợp lệ',
            'nam_tot_nghiep.min' => 'Năm Tốt nghiệp không hợp lệ',
            'nam_tot_nghiep.max' => 'Năm Tốt nghiệp không hợp lệ',
        ];
    }

    public function attributes()
    {
        return [
            'ten' => 'Họ và tên',
            'email' => 'Email',
            'gioi_tinh' => 'Giới tính',
            'ngay_sinh' => 'Ngày sinh',
            'dan_toc' => 'Dân tộc',
            'dien_thoai' => 'Số điện thoại',
            'so_cmtnd' => 'Chứng minh thư',
            'ngay_cap_cmtnd' => 'Ngày cấp',
            'noi_cap_cmtnd_matp' => 'Nơi cấp',
            'ho_khau_thuong_tru_matp' => 'Thành phố',
            'ho_khau_thuong_tru_maqh' => 'Quận huyện',
            'ho_khau_thuong_tru_xaid' => 'Xã phường',
            'ho_khau_thuong_tru_so_nha' => 'Thôn/Số nhà',
            'noi_o_hien_tai_matp' => 'Thành phố',
            'noi_o_hien_tai_maqh' => 'Quận huyện',
            'noi_o_hien_tai_xaid' => 'Xã phường',
            'noi_o_hien_tai_so_nha' => 'Thôn/Số nhà',
            'trinh_do'  => 'Trình độ',
            'chuyen_mon'  => 'Chuyên môn',
            'noi_dao_tao'  => 'Nơi đào tạo',
            'nam_tot_nghiep'  => 'Năm tốt nghiệp',
        ];
    }
}
