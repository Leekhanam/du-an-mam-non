<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChiTietDonThuoc;
use App\Models\HocSinh;
use App\Models\Lop;

class DonDanThuoc extends Model
{
    protected $table = 'don_dan_thuoc';
    protected $fillable = 
    [
        "id",
        "lop_id",
        "hoc_sinh_id",
        'ngay_bat_dau',
        "ngay_ket_thuc",
        "noi_dung",
        "trang_thai",
        "anh"
    ];
    public function ChiTietDonThuoc()
    {
        return $this->hasMany(ChiTietDonThuoc::class,'don_dan_thuoc_id');
    }
    public function HocSinh()
    {
        return $this->belongsTo(HocSinh::class, 'hoc_sinh_id','id');
    }
    public function Lop()
    {
        return $this->belongsTo(Lop::class, 'lop_id','id');
    }
    public function PhuHuynh()
    {
        return $this->belongsTo(PhuHuynh::class,'user_id','id');
    }

}
