<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin;
    }

    public function view(User $user, Organization $organization)
    {
        return
            $user->isAdmin ||
            $user->organization_id == $organization->id;
    }

    public function create(User $user)
    {
        return $user->isAdmin;
    }

    public function update(User $user, Organization $organization)
    {
        return
            $user->isAdmin ||
            $user->organization_id == $organization->id;
    }

    public function delete(User $user, Organization $organization)
    {
        return $user->isAdmin;
    }

    public function restore(User $user, Organization $organization)
    {
        return $user->isAdmin;
    }

    public function forceDelete(User $user, Organization $organization)
    {
        return $user->isAdmin;
    }
}
