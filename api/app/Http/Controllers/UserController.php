<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserRequest $request)
    {
        try {

            $userData = $request->only('name', 'email', 'password');

            $user = $this->userService->create(
                $userData['name'],
                $userData['email'],
                $userData['password']
            );

            return response()->json($user, 201);
        } catch (\Exception $exception) {
            return response()->json("Houve um erro interno", 500);
        }
    }

}
