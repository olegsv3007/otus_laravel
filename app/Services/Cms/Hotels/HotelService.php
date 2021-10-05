<?php

namespace App\Services\Cms\Hotels;

use App\Models\City;
use App\Models\Hotel;
use App\Models\User;
use App\Services\Cms\Hotels\Repositories\HotelRepository;
use App\Services\ItemsForSelectInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelService implements ItemsForSelectInterface
{
    public function __construct(
        private HotelRepository $hotelRepository
    )
    { }

    public function get(): Collection
    {
        return $this->hotelRepository->get(auth()->user()->organization_id);
    }

    public function getPaginate(int $count = null, int $linksLimit = null): ?LengthAwarePaginator
    {
        return
            $this->hotelRepository->getPaginate(auth()->user()->organization_id, $count, $linksLimit) ??
            new LengthAwarePaginator([], 0, 1);
    }

    public function store(array $data, User $user): ?Hotel
    {
        if ($fileName = $this->storeHotelImage($data['main_image'])) {
            $data['main_image'] = $fileName;
        }

        return $this->hotelRepository->store($data, $user);
    }

    public function update(array $data, Hotel $hotel): ?Hotel
    {
        if (isset($data['main_image'])) {
            if ($fileName = $this->storeHotelImage($data['main_image'])) {
                $data['main_image'] = $fileName;
            }
        }

        return $this->hotelRepository->update($data, $hotel);
    }

    public function delete(Hotel $hotel): bool
    {
        return $this->hotelRepository->delete($hotel);
    }

    public function storeHotelImage(UploadedFile $file): ?string
    {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        if (!$file->storeAs(Hotel::FOLDER_PHOTOS, $fileName, 'images')) {
            return null;
        }

        return $fileName;
    }

    public function getItemsForSelect(): Collection
    {
        return $this->get();
    }

    public function resore(Hotel $hotel): ?bool
    {
        return $this->hotelRepository->restore($hotel);
    }
}
