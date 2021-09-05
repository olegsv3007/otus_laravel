<?php

namespace App\Services\Cms\Organizations\Repositories;

use App\Models\Hotel;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrganizationRepository
{
    public function get(): Collection
    {
        return Organization::withoutGlobalScopes()->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return Organization::withTrashed()
            ->paginate($count ?? config('cms.pagination.items_per_page'))
            ->onEachSide($linksLimit ?? config('cms.pagination.links_limit'));
    }

    public function store(array $data): Organization|bool
    {
        $organization = Organization::create($data);

        if (!$organization) {
            return false;
        }

        return $organization;
    }

    public function update(array $data, Organization $organization): Organization|bool
    {
        if (!$organization->update($data)) {
            return false;
        }

        return $organization;
    }

    public function delete(Organization $organization): bool
    {
        if (!$organization->delete()) {
            return false;
        }

        return true;
    }
    public function restore(Organization $organization)
    {
        return $organization->restore();
    }
}
