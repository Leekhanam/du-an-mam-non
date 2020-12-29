<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhuHuynh extends Model
{
    protected $table = 'phu_huynh';
    protected $fillable = 
    [
        "id",
        "user_id ",
        "hoc_sinh_id",
    ];
    public function HocSinh()
    {
        return $this->hasOne(HocSinh::class,'hoc_sinh_id','id');
    }
}
