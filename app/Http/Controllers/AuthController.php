<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function array_merge;
use function compact;
use function event;

class AuthController extends Controller
{
    public function __construct(public AuthService $auth_service)
    {
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::create($request->payload());

        $token = $user->createToken('Personal Access Token');

        event(new Registered($user));

        return $this->respondCreated(
            UserResource::make(array_merge(
                compact('user'),
                $token->toArray()
            )));
    }

    public function login(UserLoginRequest $request)
    {
        $user = $request->authenticate();

        return $this->respondWithSuccess(array_merge([
            'user' => UserResource::make($user),
        ], $user->createToken('Personal Access Token')->toArray()));
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->respondWithSuccess(['message' => 'The personal access token has been deleted.']);
    }
}
