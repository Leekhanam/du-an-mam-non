<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    protected $table = 'devvn_quanhuyen';
    protected $fillable = [
        'name',
        'type',
        'matp',
    ];
}
