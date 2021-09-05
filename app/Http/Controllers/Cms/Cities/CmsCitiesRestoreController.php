<?php

namespace App\Http\Controllers\Cms\Cities;

use App\Models\City;
use App\Services\Routes\Providers\Cms\CmsRoutes;

class CmsCitiesRestoreController extends BaseCmsCitiesController
{
    public function __invoke(City $city)
    {
        $this->getCityService()->restore($city);

        return redirect()->route(CmsRoutes::CMS_CITIES_INDEX);
    }
}
