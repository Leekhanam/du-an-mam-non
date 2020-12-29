<?php


namespace App\Services\Auth;

use Illuminate\Http\Request;
use App\Services\AppService;


class AuthService extends AppService
{
    public function getRepository()
    {
        return \App\Repositories\Auth\AuthRepositoryInterface::class;
    }  
    
  
}
