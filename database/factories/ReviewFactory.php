<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->text(400),
            'mark' => $this->faker->numberBetween(1,5),
            'moderated' => $this->faker->boolean(95),
            'created_at' => now(),
        ];
    }
}
