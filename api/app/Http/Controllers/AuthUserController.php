<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Services\AuthUserService;

use Illuminate\Validation\UnauthorizedException;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    private $authUserService;

    public function __construct(AuthUserService $authUserService)
    {
        $this->authUserService = $authUserService;
    }

    protected function auth(AuthUserRequest $request)
    {
        try {
            $request = $request->only('email', 'password');
            $token = $this->authUserService->auth($request['email'], $request['password']);

            return response()->json(['token' => $token], 200);
        } catch (UnauthorizedException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        } catch (\Exception $exception) {
            return response()->json("Houve um erro interno", 500);
        }
    }

    protected function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
        } catch (UnauthorizedException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        } catch (\Exception $exception) {
            return response()->json("Houve um erro interno", 500);
        }
    }
}
