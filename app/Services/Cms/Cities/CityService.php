<?php

namespace App\Services\Cms\Cities;

use App\Models\City;
use App\Services\Cms\Cities\Repositories\CityRepository;
use App\Services\ItemsForSelectInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\Constraint\Count;

class CityService implements ItemsForSelectInterface
{
    public function __construct(
        private CityRepository $cityRepository,
    )
    { }

    public function get(): Collection
    {
        return $this->cityRepository->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return $this->cityRepository->getPaginate($count, $linksLimit);
    }

    public function store(array $data): ?City
    {
        return $this->cityRepository->store($data);
    }

    public function update(array $data, City $city): ?City
    {
        return $this->cityRepository->update($data, $city);
    }

    public function delete(City $city): bool
    {
        return $this->cityRepository->delete($city);
    }

    public function getItemsForSelect(): Collection
    {
        return $this->cityRepository->getItemsForSelect();
    }

    public function restore(City $city): ?bool
    {
        return $this->cityRepository->restore($city);
    }
}
