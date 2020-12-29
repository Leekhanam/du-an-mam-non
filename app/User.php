<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\HocSinh;
use App\Models\GiaoVien;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'token', 'time_code', 'avatar', 'role','active', 'phone_number', 'device',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function HocSinh()
    {
        return $this->hasMany(HocSinh::class,'user_id','id');
    }
    public function GiaoVien()
    {
        return $this->hasOne(GiaoVien::class,'user_id','id');
    }


}
