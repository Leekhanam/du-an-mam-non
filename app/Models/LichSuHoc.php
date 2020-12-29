<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HocSinh;
use App\Models\Lop;

class LichSuHoc extends Model
{
    protected $table = 'lich_su_hoc';
    protected $fillable = 
    [
        "hoc_sinh_id",
        'lop_id',
    ];
    // public function LopHoc()
    // {
    //     return $this->hasMany(Lop::class,'lop_id','id');
    // }

    public function HocSinh()
    {
        return $this->belongsto(HocSinh::class,'hoc_sinh_id','id');
    }

    public function Lop()
    {
        return $this->belongsto(Lop::class,'lop_id','id');
    }
}
