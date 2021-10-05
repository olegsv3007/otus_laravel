<?php

namespace App\Services\Cms\Cities\Repositories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CityRepository
{
    public function get(): Collection
    {
        return Cache::tags([City::CACHE_TAG])->remember(
            'cms_all_cities',
            config('cms.cache.lifetime'),
            function () {
                return City::withoutGlobalScopes()->get();
            }
        );
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return Cache::tags([City::CACHE_TAG, Country::CACHE_TAG])->remember(
            'cms_paginated_cities',
            config('cms.cache.lifetime'),
            function () {
                return City::withTrashed()
                    ->with(['country' => function ($query) {
                        return $query->withTrashed();
                    }])
                    ->paginate($count ?? config('cms.pagination.items_per_page'))
                    ->onEachSide($linksLimit ?? config('cms.pagination.links_limit'));
            });
    }

    public function store(array $data): ?City
    {
        $city = City::create($data);

        if (!$city) {
            return null;
        }

        return $city;
    }

    public function update(array $data, City $city): ?City
    {
        if (!$city->update($data)) {
            return null;
        }

        return $city;
    }

    public function delete(City $city): bool
    {
        if (!$city->delete()) {
            return false;
        }

        return true;
    }

    public function getItemsForSelect(): Collection
    {
        return $this->get();
    }

    public function restore(City $city): ?bool
    {
        return $city->restore();
    }
}
