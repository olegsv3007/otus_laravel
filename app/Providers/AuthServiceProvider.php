<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Organization' => 'App\Policies\OrganizationPolicy',
        'App\Models\Hotel' => 'App\Policies\HotelPolicy',
        'App\Models\Apartment' => 'App\Policies\ApartmentPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
