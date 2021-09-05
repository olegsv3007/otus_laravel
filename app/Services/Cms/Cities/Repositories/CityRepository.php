<?php

namespace App\Services\Cms\Cities\Repositories;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CityRepository
{
    public function get(): Collection
    {
        return City::withoutGlobalScopes()->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return City::withTrashed()
            ->with(['country' => function($query) {
                return $query->withTrashed();
            }])
            ->paginate($count ?? config('cms.pagination.items_per_page'))
            ->onEachSide($linksLimit ?? config('cms.pagination.links_limit'));
    }

    public function store(array $data): City|bool
    {
        $city = City::create($data);

        if (!$city) {
            return false;
        }

        return $city;
    }

    public function update(array $data, City $city): City|bool
    {
        if (!$city->update($data)) {
            return false;
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

    public function restore(City $city)
    {
        return $city->restore();
    }
}
