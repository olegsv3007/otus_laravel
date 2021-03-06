<?php

namespace App\Http\Controllers\Cms\Hotels;

use App\Models\Hotel;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;

class CmsHotelsRestoreController extends BaseCmsHotelsController
{

    public function __invoke(Hotel $hotel): RedirectResponse
    {
        $this->authorize('restore', $hotel);

        $this->getHotelService()->restore($hotel);

        return redirect()->route(CmsRoutes::CMS_HOTELS_INDEX, ['locale' => $this->getLocale()]);
    }
}
