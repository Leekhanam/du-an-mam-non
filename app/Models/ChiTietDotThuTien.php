<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KhoanThu;
use App\Models\ThangThuTien;


class ChiTietDotThuTien extends Model
{
    protected $table = 'chi_tiet_dot_thu';
    protected $fillable = 
    [
        "id",
        "ten_dot_thu",
        "id_thang_thu_tien"
    ];
    public function KhoanThu()
    {
        return $this->hasMany(KhoanThu::class,'id_dot_thu_tien','id');
    }

    public function ThangThuTien()
    {
        return $this->belongsTo(ThangThuTien::class,'id_thang_thu_tien','id');
    }

    

   
}
