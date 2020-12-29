<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinhThanhPho extends Model
{
    protected $table = 'devvn_tinhthanhpho';
    protected $fillable = [
        'name',
        'type',
    ];
}
