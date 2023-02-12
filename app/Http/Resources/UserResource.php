<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property mixed $email_verified_at
 * @property mixed $created_at
 * @property mixed $blocked_at
 * @property mixed $phone_verified_at
 * @property string $bio
 * @property string $display_name
 * @property string $gender
 */
class UserResource extends JsonResource
{

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'display_name' => $this->display_name,
            'gender' => $this->gender,
            'email_verified_at' => $this->email_verified_at,
            'phone_verified_at' => $this->phone_verified_at,
            'blocked_at' => $this->blocked_at,
            'created_at' => $this->created_at,
        ];
    }
}
