<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Http\Controllers\Controller;
use App\Services\Cms\Countries\CountryService;

class BaseCmsCountriesController extends Controller
{
    protected function getCountryService(): CountryService
    {
        return app(CountryService::class);
    }
}
