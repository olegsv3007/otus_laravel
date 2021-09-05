<?php

namespace App\Services\Cms\Apartments\Repositories;

use App\Models\Apartment;
use App\Models\Image;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApartmentRepository
{
    public function get(): Collection
    {
        return Apartment::withoutGlobalScopes()
            ->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return Apartment::withoutGlobalScopes()
            ->with(['hotel' => function ($query) {
                return $query->withTrashed();
            }])
            ->paginate($count ?? config('cms.pagination.items_per_page'))
            ->onEachSide($linksLimit ?? config('cms.pagination.links_limit'));
    }

    public function store(array $data, array $images): Apartment|bool
    {
        $apartment = Apartment::create($data);

        if (!$apartment) {
            return false;
        }

        foreach ($images as $image) {
            $apartment->images()->create(['filename' => $image]);
        }

        return $apartment;
    }

    public function update(array $data, Apartment $apartment, array $images): Apartment|bool
    {
        if (!$apartment->update($data)) {
            return false;
        }

        foreach ($images as $image) {
            $apartment->images()->create(['filename' => $image]);
        }

        return $apartment;
    }

    public function find($id)
    {
        return Apartment::withoutGlobalScope(ActiveScope::class)->findOrFail($id);
    }

    public function delete(Apartment $apartment): bool
    {
        if (!$apartment->delete()) {
            return false;
        }

        return true;
    }

    public function restore(Apartment $apartment)
    {
        return $apartment->restore();
    }
}
