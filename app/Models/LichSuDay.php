<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HocSinh;
use App\Models\Lop;
use App\Models\GiaoVien;


class LichSuDay extends Model
{
    protected $table = 'lich_su_day';
    protected $fillable = 
    [
        "giao_vien_id",
        'lop_id',
        'type'
    ];
    public function LopHoc()
    {
        return $this->belongsto(Lop::class,'lop_id','id');
    }

    public function GiaoVien()
    {
        return $this->belongsto(GiaoVien::class,'giao_vien_id','id');
    }
}
