<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThongTinTruong extends Model
{
    protected $table = 'thong_tin_truong';
    protected $fillable = [
        'name',
        'address',
        'hotline',
        'email'
    ];
}
