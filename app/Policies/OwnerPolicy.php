<?php

namespace App\Policies;

use App\Owner;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OwnerPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Owner $owner)
    {
        return $user->is($owner->user);
    }

    public function update(User $user, Owner $owner)
    {
        return $user->is($owner->user) || $owner->members->contains($user);
    }
}
