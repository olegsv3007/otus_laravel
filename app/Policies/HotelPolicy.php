<?php

namespace App\Policies;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HotelPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin;
    }

    public function view(User $user, Hotel $hotel)
    {
        return $user->organization_id == $hotel->organization_id;
    }

    public function create(User $user)
    {
        return $user->isManager;
    }

    public function update(User $user, Hotel $hotel)
    {
        return $user->organization_id == $hotel->organization_id;
    }

    public function delete(User $user, Hotel $hotel)
    {
        return $user->organization_id == $hotel->organization_id;
    }

    public function restore(User $user, Hotel $hotel)
    {
        return $user->organization_id == $hotel->organization_id;
    }

    public function forceDelete(User $user, Hotel $hotel)
    {
        return $user->admin;
    }
}
