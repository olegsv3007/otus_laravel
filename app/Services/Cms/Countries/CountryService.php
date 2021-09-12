<?php

namespace App\Services\Cms\Countries;

use App\Models\Country;
use App\Services\Cms\Countries\Repositories\CountryRepository;
use App\Services\ItemsForSelectInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\Constraint\Count;

class CountryService implements ItemsForSelectInterface
{
    public function __construct(
        private CountryRepository $countryRepository,
    )
    { }

    public function get(): Collection
    {
        return $this->countryRepository->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return $this->countryRepository->getPaginate($count, $linksLimit);
    }

    public function store(array $data): ?Country
    {
        return $this->countryRepository->store($data);
    }

    public function update(array $data, Country $country): ?Country
    {
        return $this->countryRepository->update($data, $country);
    }

    public function delete(Country $country): bool
    {
        return $this->countryRepository->delete($country);
    }

    public function getItemsForSelect(): Collection
    {
        return $this->get();
    }

    public function restore(Country $country): ?bool
    {
        return $this->countryRepository->restore($country);
    }
}
