<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DonDanThuoc;

class ChiTietDonThuoc extends Model
{
    protected $table = 'chi_tiet_don_thuoc';
    protected $fillable = 
    [
        "id",
        "don_dan_thuoc_id",
        "ten_thuoc",
        'don_vi',
        "lieu_luong",
        "phan_hoi_giao_vien",
        "trang_thai",
        "anh",
        "ghi_chu"   
       
    ];
    public function DonDanThuoc()
    {
        return $this->belongsTo(DonDanThuoc::class,'id');
    }
}
