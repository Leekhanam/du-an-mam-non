<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = "album";
    protected $fillable = ['title', 'item_images', 'auth_id', 'lop_id'];
}
