<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        $dateStart = now()->addDay($this->faker->randomNumber(2));
        $dateEnd = $dateStart->addDay($this->faker->randomNumber(2));

        return [
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'price' => $this->faker->randomFloat(2, 1, 1000000),
            'created_at' => now(),
        ];
    }
}
