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
use Illuminate\Support\Facades\Log;

class HotelService implements ItemsForSelectInterface
{
    public function __construct(
        private HotelRepository $hotelRepository
    )
    { }

    public function get(): Collection
    {
        return $this->hotelRepository->get();
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

        $result = $this->hotelRepository->store($data, $user);

        $result ?
            Log::info("User {$user->name} ({$user->id}) created new hotel.", ['hotel' => $data]) :
            Log::critical("User {$user->name} ({$user->id}) couldn't create new hotel.", ['hotel' => $data]);

        return $result;
    }

    public function update(array $data, Hotel $hotel): ?Hotel
    {
        if (isset($data['main_image'])) {
            if ($fileName = $this->storeHotelImage($data['main_image'])) {
                $data['main_image'] = $fileName;
            }
        }

        $oldHotelData = $hotel->attributesToArray();
        $result = $this->hotelRepository->update($data, $hotel);
        $actingUser = auth()->user();

        $result ?
            Log::info("User {$actingUser->name} ({$actingUser->id}) updated hotel.", ['oldHotelData' => $oldHotelData, 'newHotelData' => $hotel]) :
            Log::critical("User {$actingUser->name} ({$actingUser->id}) couldn't update hotel.", ['oldHotelData' => $oldHotelData, 'newHotelData' => $data]);

        return $result;
    }

    public function delete(Hotel $hotel): bool
    {
        $result = $this->hotelRepository->delete($hotel);
        $actingUser = auth()->user();

        $result ?
            Log::info("User {$actingUser->name} ({$actingUser->id}) deleted hotel.", ['hotel' => $hotel]) :
            Log::critical("User {$actingUser->name} ({$actingUser->id}) couldn't delete hotel.", ['hotel' => $hotel]);


        return $result;
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
        return $this->hotelRepository->getItemsForSelect(auth()->user()->organization_id);
    }

    public function restore(Hotel $hotel): ?bool
    {
        return $this->hotelRepository->restore($hotel);
    }
}
