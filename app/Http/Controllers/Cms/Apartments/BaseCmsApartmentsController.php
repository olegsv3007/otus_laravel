<?php

namespace App\Http\Controllers\Cms\Apartments;

use App\Http\Controllers\Controller;
use App\Services\Cms\Apartments\ApartmentService;
use Illuminate\Http\Request;

class BaseCmsApartmentsController extends Controller
{
    protected function getApartmentService(): ApartmentService
    {
        return app(ApartmentService::class);
    }
}
