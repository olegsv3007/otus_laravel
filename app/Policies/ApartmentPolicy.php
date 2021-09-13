<?php

namespace App\Policies;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin;
    }

    public function view(User $user, Apartment $apartment)
    {
        return $user->organization_id == $apartment->hotel->organization_id;
    }

    public function create(User $user)
    {
        return $user->isManager;
    }

    public function update(User $user, Apartment $apartment)
    {
        return $user->organization_id == $apartment->hotel->organization_id;
    }

    public function delete(User $user, Apartment $apartment)
    {
        return $user->organization_id == $apartment->hotel->organization_id;
    }

    public function restore(User $user, Apartment $apartment)
    {
        return $user->organization_id == $apartment->hotel->organization_id;
    }

    public function forceDelete(User $user, Apartment $apartment)
    {
        return $user->isAdmin;
    }
}
