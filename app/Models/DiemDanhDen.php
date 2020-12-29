<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiemDanhDen extends Model{
    protected $table = 'diem_danh_den';
    protected $fillable = 
    [
        "id",
        "ngay_diem_danh_den",
        "hoc_sinh_id",
        "giao_vien_id",
        "chu_thich",
        "type",
        "trang_thai",
        "lop_id"
    ];
}
