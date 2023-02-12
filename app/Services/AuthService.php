<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use function array_merge;

class AuthService
{
    public function create(array $data): array
    {
        /** @var User $user */
        $user = User::create($data);

        $token = $user->createToken('Personal Access Token');

        event(new Registered($user));

        return UserResource::make(array_merge(compact('user'), $token->toArray()));
    }

    public function login(array $data): array
    {


    }
}
