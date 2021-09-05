<?php

namespace App\Services\Cms\Organizations;

use App\Models\Organization;
use App\Services\Cms\Organizations\Repositories\OrganizationRepository;
use App\Services\ItemsForSelectInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrganizationService implements ItemsForSelectInterface
{
    public function __construct(
        private OrganizationRepository $organizationRepository,
    )
    { }

    public function get(): Collection
    {
        return $this->organizationRepository->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return $this->organizationRepository->getPaginate($count, $linksLimit);
    }

    public function store(array $data): Organization|bool
    {
        return $this->organizationRepository->store($data);
    }

    public function update(array $data, Organization $organization): Organization|bool
    {
        return $this->organizationRepository->update($data, $organization);
    }

    public function delete(Organization $organization): bool
    {
        return $this->organizationRepository->delete($organization);
    }

    public function getItemsForSelect(): Collection
    {
        return $this->get();
    }

    public function restore(Organization $organization)
    {
        return $this->organizationRepository->restore($organization);
    }
}
