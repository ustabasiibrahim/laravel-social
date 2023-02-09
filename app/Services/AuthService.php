<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthService
{
    public function create(array $data): array
    {
        /** @var User $user */
        $user = User::create($data);

        $token = $user->createToken('Personal Access Token');

        event(new Registered($user));

        return array_merge(compact('user'), $token->toArray());
    }
}
