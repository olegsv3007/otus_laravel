<?php

namespace App\Http\Controllers\Cms\Cities;

use App\Models\City;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;

class CmsCitiesRestoreController extends BaseCmsCitiesController
{
    public function __invoke(City $city): RedirectResponse
    {
        $this->getCityService()->restore($city);

        return redirect()->route(CmsRoutes::CMS_CITIES_INDEX, ['locale' => $this->getLocale()]);
    }
}
