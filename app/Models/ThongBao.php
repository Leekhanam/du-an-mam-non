<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    protected $table = 'thong_bao';
    protected $fillable = [
        'thongbao_id',
        'user_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
