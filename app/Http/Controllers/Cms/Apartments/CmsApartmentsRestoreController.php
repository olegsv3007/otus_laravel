<?php

namespace App\Http\Controllers\Cms\Apartments;

use App\Models\Apartment;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;

class CmsApartmentsRestoreController extends BaseCmsApartmentsController
{

    public function __invoke(Apartment $apartment): RedirectResponse
    {
        $this->getApartmentService()->restore($apartment);

        return redirect()->route(CmsRoutes::CMS_APARTMENTS_INDEX, ['locale' => $this->locale]);
    }
}
