<?php

namespace App\Services\Cms\Apartments;

use App\Models\Apartment;
use App\Models\Image;
use App\Services\Cms\Apartments\Repositories\ApartmentRepository;
use App\Services\ItemsForSelectInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class ApartmentService
{
    public function __construct(
        private ApartmentRepository $apartmentRepository
    )
    { }

    public function get(): Collection
    {
        return $this->apartmentRepository->get();
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        return $this->apartmentRepository->getPaginate($count, $linksLimit);
    }

    public function store(array $data): Apartment|bool
    {
        $data['main_image'] = $this->storeImage($data['main_image']);
        $images = $this->storeImages($data['images']);
        unset($data['images']);

        return $this->apartmentRepository->store($data, $images);
    }

    public function update(array $data, Apartment $apartment): Apartment|bool
    {
        if (isset($data['main_image'])) {
            if ($fileName = $this->storeImage($data['main_image'])) {
                $data['main_image'] = $fileName;
            }
        }

        $images = [];

        if (isset($data['images'])) {
            $images = $this->storeImages($data['images']);
            unset($data['images']);
        }

        return $this->apartmentRepository->update($data, $apartment, $images);
    }

    public function delete(Apartment $apartment): bool
    {
        return $this->apartmentRepository->delete($apartment);
    }

    private function storeImage(UploadedFile $file): string|false
    {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        if (!$file->storeAs(Apartment::FOLDER_PHOTOS, $fileName, 'images')) {
            return false;
        }

        return $fileName;
    }

    public function find($id)
    {
        return $this->apartmentRepository->find($id);
    }

    private function storeImages($images): array
    {
        $imagesNames = [];

        foreach ($images as $image) {
            $imagesNames[] = $this->storeImage($image);
        }

        return $imagesNames;
    }

    public function restore(Apartment $apartment)
    {
        return $this->apartmentRepository->restore($apartment);
    }
}
