<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\ThoiHoc;
use App\Models\Lop;
use App\Models\LichSuHoc;
use App\Models\DiemDanhDen;
use App\Models\DiemDanhVe;
use App\Models\DonNghiHoc;
use App\Models\DonDanThuoc;


class HocSinh extends Model
{
    protected $table = 'hoc_sinh';
    protected $fillable = [
        'id',
        'lop_id',
        'ten',
        'gioi_tinh',
        'ma_hoc_sinh',
        'ten_thuong_goi',
        'avatar',
        'ngay_sinh',
        'noi_sinh',
        'dan_toc',
        'ngay_vao_truong',
        'doi_tuong_chinh_sach',
        'hoc_sinh_khuyet_tat',
        'ten_cha',
        'ngay_sinh_cha',
        'cmtnd_cha',
        'dien_thoai_cha',
        'ten_me',
        'ngay_sinh_me',
        'cmtnd_me',
        'dien_thoai_me',
        'ten_nguoi_giam_ho',
        'dien_thoai_nguoi_giam_ho',
        'cmtnd_nguoi_giam_ho',
        'dien_thoai_dang_ky',
        'email_dang_ky',
        'ho_khau_thuong_tru_matp',
        'ho_khau_thuong_tru_maqh',
        'ho_khau_thuong_tru_xaid',
        'ho_khau_thuong_tru_so_nha',
        'noi_o_hien_tai_matp',
        'noi_o_hien_tai_maqh',
        'noi_o_hien_tai_xaid',
        'noi_o_hien_tai_so_nha',
        'type',
        'user_id'
    ];


    public function ThoiHoc()
    {
        return $this->hasOne(ThoiHoc::class,'hoc_sinh_id','id');
    }

    public function Lop()
    {
        return $this->belongsTo(Lop::class,'lop_id','id');
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function LichSuHoc()
    {
        return $this->hasMany(LichSuHoc::class,'hoc_sinh_id','id');
    }

    public function DiemDanhDen()
    {
        return $this->hasMany(DiemDanhDen::class,'hoc_sinh_id','id');
    }
    
    public function DonNghiHoc()
    {
        return $this->hasMany(DonNghiHoc::class,'hoc_sinh_id','id');
    }
    public function DonDanThuoc()
    {
        return $this->hasMany(DonDanThuoc::class,'hoc_sinh_id','id');
    }
    public function PhuHuynh()
    {
        return $this->hasOne(PhuHuynh::class,'hoc_sinh_id','id');
    }
    public function DiemDanhVe()
    {
        return $this->hasMany(DiemDanhVe::class,'hoc_sinh_id','id');
    }
}
