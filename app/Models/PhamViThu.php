<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhamViThu extends Model
{
    protected $table = 'pham_vi_thu';
    protected $fillable = 
    [
        "id_khoan_thu",
        "id_khoi_lop_thu",
    ];
}
