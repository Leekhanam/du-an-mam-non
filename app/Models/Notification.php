<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use QuanVT\Firebase\SyncWithFirebase;

class Notification extends Model
{
    use Notifiable, SyncWithFirebase;

    protected $table = 'notification';
    protected $fillable = ['title', 
                           'content', 
                           'route',
                           'user_id', 
                           'role', 
                           'auth_id', 
                           'type', 
                           'bell',
                           'id_hs',
                           'created_at',
                           'updated_at'
                        ];
}
