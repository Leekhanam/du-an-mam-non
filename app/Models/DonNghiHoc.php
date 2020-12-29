<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HocSinh;
class DonNghiHoc extends Model
{
    protected $table = "don_nghi_hoc";

    public function HocSinh()
    {
        return $this->belongsTo(HocSinh::class, 'hoc_sinh_id','id');
    }
}
