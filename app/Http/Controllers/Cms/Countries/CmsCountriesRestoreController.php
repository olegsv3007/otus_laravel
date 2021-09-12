<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Models\Country;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;

class CmsCountriesRestoreController extends BaseCmsCountriesController
{

    public function __invoke(Country $country): RedirectResponse
    {
        $this->getCountryService()->restore($country);

        return redirect()->route(CmsRoutes::CMS_COUNTRIES_INDEX);
    }
}
