<?php

namespace App\Services\Cms\Hotels\Repositories;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelRepository
{
    public function get(): Collection
    {
        return Hotel::withoutGlobalScopes()
            ->where('organization_id', auth()->user()->organization_id)
            ->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): ?LengthAwarePaginator
    {
        return Hotel::withoutGlobalScopes()
            ->where('organization_id', auth()->user()->organization_id)
            ->with([
                'organization' => function ($query) {
                    return $query->withTrashed();
                },
                'city' => function ($query) {
                    return $query->withTrashed();
                }])
            ->paginate($count ?? config('cms.pagination.items_per_page'))
            ->onEachSide($linksLimit ?? config('cms.pagination.links_limit'));
    }

    public function store(array $data, User $user): ?Hotel
    {
        $hotel = $user
            ->organization
            ->hotels()
            ->create($data);

        if (!$hotel) {
            return null;
        }

        return $hotel;
    }

    public function update(array $data, Hotel $hotel): ?Hotel
    {
        if (!$hotel->update($data)) {
            return null;
        }

        return $hotel;
    }

    public function delete(Hotel $hotel): bool
    {
        if (!$hotel->delete()) {
            return false;
        }

        return true;
    }

    public function restore(Hotel $hotel): ?bool
    {
        return $hotel->restore();
    }
}
