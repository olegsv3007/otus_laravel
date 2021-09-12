<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition()
    {
        $path = $this->faker->image(public_path('/img/' . Apartment::FOLDER_PHOTOS), 300, 200, null, false);

        return [
            'filename' => $path,
        ];
    }
}
