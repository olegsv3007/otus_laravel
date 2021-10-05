<?php

namespace App\Services\Cms\Countries\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CountryRepository
{
    public function get(): Collection
    {
        return Cache::tags([Country::CACHE_TAG])
            ->remember(
                'cmd_all_countries',
                config('cms.cache.lifetime'),
                function() {
                    return Country::withoutGlobalScopes()->get();
                });
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return Cache::tags([Country::CACHE_TAG])->remember(
            'cms_paginated_countries',
            config('cms.cache.lifetime'),
            function() {
                return Country::withoutGlobalScopes()
                    ->paginate($count ?? config('cms.pagination.items_per_page'))
                    ->onEachSide($linksLimit ?? config('cms.pagination.links_limit'));
             });
    }

    public function store(array $data): ?Country
    {
        $country = Country::create($data);

        if (!$country) {
            return null;
        }

        return $country;
    }

    public function update(array $data, Country $country): ?Country
    {
        if (!$country->update($data)) {
            return null;
        }

        return $country;
    }

    public function delete(Country $country): bool
    {
        if (!$country->delete()) {
            return false;
        }

        return true;
    }

    public function restore(Country $country): ?bool
    {
        return $country->restore();
    }
}
