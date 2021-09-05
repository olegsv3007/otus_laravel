<?php

namespace App\Http\Controllers\Cms\Apartments;

use App\Models\Apartment;
use App\Services\Routes\Providers\Cms\CmsRoutes;

class CmsApartmentsRestoreController extends BaseCmsApartmentsController
{

    public function __invoke(Apartment $apartment)
    {
        $this->getApartmentService()->restore($apartment);

        return redirect()->route(CmsRoutes::CMS_APARTMENTS_INDEX);
    }
}
