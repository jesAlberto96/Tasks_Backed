<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    public static function getOneByWhere($where)
    {
        return User::where($where)->first();
    }

}
