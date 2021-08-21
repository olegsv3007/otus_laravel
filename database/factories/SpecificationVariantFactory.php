<?php

namespace Database\Factories;

use App\Models\SpecificationVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecificationVariantFactory extends Factory
{
    protected $model = SpecificationVariant::class;

    public function definition(): array
    {
        return [
            'variant' => $this->faker->words(2, true),
        ];
    }
}
