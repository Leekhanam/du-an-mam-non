<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ThongKeFeedBack extends Model
{
    protected $table = 'danh_gia_phu_huynh';
    protected $fillable = [
        'user_id',
        'lop_id',
        'noi_dung',
        'trang_thai'
    ];
}