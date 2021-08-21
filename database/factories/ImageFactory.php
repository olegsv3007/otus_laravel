<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition()
    {
        $path = "/faker/" . $this->faker->image(storage_path('app/public/faker'), 300, 200, null, false);

        return [
            'path' => $path,
        ];
    }
}
