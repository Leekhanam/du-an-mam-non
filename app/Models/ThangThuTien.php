<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use APP\Models\KhoanThu;
use APP\Models\ChiTietDotThuTien;


class ThangThuTien extends Model
{
    protected $table = 'thang_thu_tien';
    protected $fillable = 
    [
        "id",
        "thang_thu",
        "nam_thu",
        'id_nam_hoc'
    ];

    public function ChiTietDotThuTien()
    {
        return $this->hasMany(ChiTietDotThuTien::class,'id_thang_thu_tien','id');
    }
}
