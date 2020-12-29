<?php

namespace App\Repositories\Auth;

use App\Repositories\BaseRepository;
use App\Repositories\Auth\AuthRepositoryInterface;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function getTable()
    {
        return "users";
    }

}