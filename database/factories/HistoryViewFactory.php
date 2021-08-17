<?php

namespace Database\Factories;

use App\Models\HistoryView;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryViewFactory extends Factory
{
    protected $model = HistoryView::class;

    public function definition(): array
    {
        $dateStart = now()->addDay($this->faker->randomNumber(2));
        $dateEnd = $dateStart->addDay($this->faker->randomNumber(2));

        return [
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'created_at' => now(),
        ];
    }
}
