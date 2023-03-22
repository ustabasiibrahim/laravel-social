<?php

namespace App\Models;

use App\Traits\Favorite\Favoriter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Traits\Follow\Followable;
use App\Traits\Follow\Follower;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,
        Notifiable,
        Favoriter,
        Followable,
        Follower,
        SoftDeletes,
        HasFactory,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'phone',
        'email_verified_at',
        'phone_verified_at',
        'blocked_at',
        'bio',
        'display_name',
        'gender',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'blocked_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
