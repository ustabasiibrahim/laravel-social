<?php

namespace App\Policies;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Channel $channel)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Channel $channel)
    {
    }

    public function delete(User $user, Channel $channel)
    {
    }

    public function restore(User $user, Channel $channel)
    {
    }

    public function forceDelete(User $user, Channel $channel)
    {
    }
}
