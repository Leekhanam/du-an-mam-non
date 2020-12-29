<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lop;
use App\Models\DanhSachThuTien;


class Khoi extends Model 
{
    protected $table = 'khoi';
    protected $fillable = 
    [
        "ten_khoi",
        'do_tuoi',
        'nam_hoc_id',
    ];
    public function LopHoc()
    {
        return $this->hasMany(Lop::class,'khoi_id','id');
    }

    public function NamHoc()
    {
        return $this->belongsTo(NamHoc::class,'nam_hoc_id','id');
    }

    public function DanhSachThuTien()
    {
        return $this->hasMany(DanhSachThuTien::class,'khoi_id','id');
    }
}
