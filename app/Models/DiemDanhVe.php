<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiemDanhVe extends Model{
    protected $table = 'diem_danh_ve';
    protected $fillable = 
    [
        "id",
        "ngay_diem_danh_ve",
        "hoc_sinh_id",
        'user_id',
        "giao_vien_id",
        "chu_thich",
        "phu_huynh",
        "trang_thai",
        "lop_id",
        'nguoi_don_ho_id'
    ];
}
