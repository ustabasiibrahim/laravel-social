<?php

namespace App\Policies;

use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Country $country): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Country $country): bool
    {
    }

    public function delete(User $user, Country $country): bool
    {
    }

    public function restore(User $user, Country $country): bool
    {
    }

    public function forceDelete(User $user, Country $country): bool
    {
    }
}
