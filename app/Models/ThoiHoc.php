<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThoiHoc extends Model
{
    protected $table = 'thoi_hoc';
    protected $fillable = [
        'hoc_sinh_id',
        'nam_hoc_id',
        'ly_do_thoi_hoc'
    ];
}
