<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DoiTuongChinhSach;
class ChinhSachCuaHocSinh extends Model
{
    protected $table = 'chi_tiet_chinh_sach_hoc_sinh';
    protected $fillable = 
    [
        "id",
        "id_hoc_sinh",
        "id_chinh_sach",
    ];

    public function DoiTuongChinhSach()
    {
       return $this->belongsTo(DoiTuongChinhSach::class,'id_chinh_sach','id');
    }
}
