<?php

namespace App\Http\Controllers\Cms\Cities;

use App\Http\Controllers\Controller;
use App\Services\Cms\Cities\CityService;
use Illuminate\Http\Request;

class BaseCmsCitiesController extends Controller
{
    protected function getCityService(): CityService
    {
        return app(CityService::class);
    }

}
