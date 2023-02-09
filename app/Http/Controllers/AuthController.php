<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(public AuthService $auth_service)
    {
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->auth_service->create($request->validated());

        return $this->respondCreated($user);
    }

    public function login(UserLoginRequest $request)
    {

    }
}
