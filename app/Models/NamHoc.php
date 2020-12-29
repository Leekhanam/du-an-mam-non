<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Khoi;
use App\Models\ThangThuTien;

class NamHoc extends Model
{
    protected $table = 'nam_hoc';
    protected $fillable = ['name', 'start_date', 'end_date','backup'];

    public function Khoi()
    {
        return $this->hasMany(Khoi::class,'nam_hoc_id','id')->orderBy('do_tuoi','asc');
    }

    public function ThangThuTien()
    {
        return $this->hasMany(ThangThuTien::class,'id_nam_hoc','id');
    }
}
