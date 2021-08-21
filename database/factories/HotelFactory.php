<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition()
    {
        $name = $this->faker->company();
        $discount = $this->faker->boolean(95) ? 0 : $this->faker->randomNumber(2);
        $image = "/faker/" . $this->faker->image(storage_path('app/public/faker'), 300, 200, null, false);

        return [
            'active' => $this->faker->boolean(95),
            'name' => $name,
            'slug' => Str::slug($name),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'address' => $this->faker->address(),
            'discount' => $discount,
            'main_image' => $image,
        ];
    }
}
