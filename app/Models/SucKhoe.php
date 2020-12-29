<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SucKhoe extends Model
{
    protected $table = 'suc_khoe';
    protected $fillable = [
        'dot_id',
        'hoc_sinh_id',
        'chieu_cao',
        'can_nang'
    ];
}
