<?php

namespace App\Http\Controllers\Cms\Organizations;

use App\Http\Controllers\Controller;
use App\Services\Cms\Organizations\OrganizationService;

class BaseCmsOrganizationsController extends Controller
{
    protected function getOrganizationService(): OrganizationService
    {
        return app(OrganizationService::class);
    }
}
