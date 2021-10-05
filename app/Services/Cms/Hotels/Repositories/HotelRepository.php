<?php

namespace App\Services\Cms\Hotels\Repositories;

use App\Models\City;
use App\Models\Hotel;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelRepository
{
    public function get(int $organizationId): Collection
    {

        return Cache::tags([Hotel::CACHE_TAG])->remember(
            "organization:$organizationId:hotels_all",
            config('cms.cache.lifetime'),
            function() use ($organizationId) {
                return Hotel::withoutGlobalScopes()
                    ->where('organization_id', $organizationId)
                    ->get();
            }
        );
    }

    public function getPaginate(int $organizationId, int $count = null, int $linksLimit = null): ?LengthAwarePaginator
    {
        return Cache::tags([Hotel::CACHE_TAG, Organization::CACHE_TAG, City::CACHE_TAG])->remember(
            "organization:$organizationId:hotels_paginated",
            config('cms.cache.lifetime'),
            function() use ($organizationId, $count, $linksLimit) {
                return Hotel::withoutGlobalScopes()
                    ->where('organization_id', $organizationId)
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
        );
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
