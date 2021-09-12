<?php

namespace App\Http\Controllers\Cms\Hotels;

use App\Models\Hotel;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;

class CmsHotelsRestoreController extends BaseCmsHotelsController
{

    public function __invoke(Hotel $hotel): RedirectResponse
    {
        $this->getHotelService()->resore($hotel);

        return redirect()->route(CmsRoutes::CMS_HOTELS_INDEX);
    }
}
