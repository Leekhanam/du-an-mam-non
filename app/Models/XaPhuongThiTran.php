<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XaPhuongThiTran extends Model
{
    protected $table = 'devvn_xaphuongthitran';
    protected $fillable = [
        'name',
        'type',
        'maqh',
    ];
}
