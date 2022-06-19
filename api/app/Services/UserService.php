<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserService
{

    public function create($name, $email, $password) : User
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        return $user;
    }

}
