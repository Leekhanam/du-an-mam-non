<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoiTuongChinhSach extends Model
{
    protected $table = 'doi_tuong_chinh_sach';
    protected $fillable = 
    [
        "id",
        "ten_chinh_sach",
        "muc_mien_giam"
    ];
}
