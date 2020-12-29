<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HocSinhDangKyNhapHoc extends Model
{
    protected $table = 'hoc_sinh_dang_ki_nhap_hoc';
    protected $fillable = [
        'lop_id',
        'ten',
        'ma_don',
        'gioi_tinh',
        'ten_thuong_goi',
        'avatar',
        'ngay_sinh',
        'dan_toc',
        'ngay_vao_truong',
        'doi_tuong_chinh_sach_id',
        'ten_cha',
        'ngay_sinh_cha',
        'cmtnd_cha',
        'dien_thoai_cha',
        'ten_me',
        'ngay_sinh_me',
        'cmtnd_me',
        'dien_thoai_me',
        'ho_khau_thuong_tru_matp',
        'ho_khau_thuong_tru_maqh',
        'ho_khau_thuong_tru_xaid',
        'ho_khau_thuong_tru_so_nha',
        'noi_o_hien_tai_matp',
        'noi_o_hien_tai_maqh',
        'noi_o_hien_tai_xaid',
        'noi_o_hien_tai_so_nha',
        'ma_xac_nhan',
        'ten_nguoi_giam_ho'
    ];

}
