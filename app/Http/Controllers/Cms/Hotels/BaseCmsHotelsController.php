<?php

namespace App\Http\Controllers\Cms\Hotels;

use App\Http\Controllers\Controller;
use App\Services\Cms\Hotels\HotelService;

class BaseCmsHotelsController extends Controller
{
    protected function getHotelService(): HotelService
    {
        return app(HotelService::class);
    }
}
