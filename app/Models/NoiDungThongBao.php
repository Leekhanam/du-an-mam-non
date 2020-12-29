<?php

namespace App\Models;

use App\Models\ThongBao;
use App\User;
use Illuminate\Database\Eloquent\Model;

class NoiDungThongBao extends Model
{
    protected $table = 'noi_dung_thong_bao';
    protected $fillable = [
        'title',
        'content',
        'auth_id',
        'type',
    ];

    public function ThongBao()
    {
        return $this->hasMany(ThongBao::class, 'thongbao_id', 'id');
    }
    public function Auth()
    {
        return $this->belongsTo(User::class, 'auth_id', 'id');
    }
}
