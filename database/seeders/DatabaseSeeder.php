<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Country;
use App\Models\HistoryView;
use App\Models\Hotel;
use App\Models\Organization;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Role;
use App\Models\Specification;
use App\Models\SpecificationVariant;
use App\Models\Status;
use App\Models\User;
use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $managerRole = Role::where('name', 'manager')->get();
        $userRole = Role::where('name', 'user')->get();

        Organization::factory()
            ->count(10)
            ->has(User::factory()
                ->count(2)
                ->hasAttached($managerRole)
            )
            ->create();

        Country::factory()
            ->count(3)
            ->has(City::factory()
                ->count(3)
                ->has(Hotel::factory()
                    ->count(2)
                    ->sequence(fn () => ['organization_id' => Organization::all()->random()])
                    ->hasImages(1)
                    ->has(Apartment::factory()
                        ->count(3)
                        ->hasImages(2)
                    )
                )
            )
            ->create();

        User::factory()
            ->count(20)
            ->hasAttached($userRole)
            ->has(HistoryView::factory()
                ->count(5)
                ->sequence(fn () => ['apartment_id' => Apartment::all()->random()]))
            ->has(Review::factory()
                ->count(5)
                ->sequence(fn () => ['apartment_id' => Apartment::all()->random()]))
            ->has(Reservation::factory()
                ->count(1)
                ->sequence(fn () => ['apartment_id' => Apartment::all()->random()])
                ->sequence(fn () => ['status_id' => Status::all()->random()]))
            ->create();

        Specification::factory()
            ->count(20)
            ->afterCreating(function (Specification $specification) {
                if ($specification->type == Specification::TYPE_SELECT) {
                    SpecificationVariant::factory()
                        ->count(4)
                        ->sequence(fn () => ['specification_id' => $specification->id])
                        ->create();
                }
            })
            ->create();
    }
}
