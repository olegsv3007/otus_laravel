<?php

namespace App\Services\Cms\Countries\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryRepository
{
    public function get(): Collection
    {
        return Country::withoutGlobalScopes()->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return Country::withoutGlobalScopes()
            ->paginate($count ?? config('cms.pagination.items_per_page'))
            ->onEachSide($linksLimit ?? config('cms.pagination.links_limit'));
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
