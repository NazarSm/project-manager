<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function findAuthUser()
    {
       return Auth::user();
    }

    public function findUserById($id)
    {
        return User::find($id);
    }

}
