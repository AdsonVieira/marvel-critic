<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Sanctum\NewAccessToken;

class AuthUserService
{
    public function auth(String $email, String $password) : NewAccessToken
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new UnauthorizedException('Seu usuário ou senha estão incorretos.');
        }

        return $user->createToken('marvel_critic_token');
    }
}
