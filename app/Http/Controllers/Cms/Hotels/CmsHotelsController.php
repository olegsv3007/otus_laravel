<?php

namespace App\Http\Controllers\Cms\Hotels;

use App\Http\Controllers\Cms\Hotels\Requests\StoreHotelRequest;
use App\Http\Controllers\Cms\Hotels\Requests\UpdateHotelRequest;
use App\Models\Hotel;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CmsHotelsController extends BaseCmsHotelsController
{

    public function index(): View
    {
        $hotels = $this->getHotelService()->getPaginate();

        return view('cms.hotels.index', compact(['hotels']));
    }

    public function create(): View
    {
        return view('cms.hotels.create');
    }

    public function store(StoreHotelRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->getHotelService()->store($validatedData, $request->user());

        return redirect()->route(CmsRoutes::CMS_HOTELS_INDEX, ['locale' => $this->locale]);
    }

    public function edit(Hotel $hotel): View
    {
        $this->authorize('view', $hotel);

        return view('cms.hotels.edit', compact(['hotel']));
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel): RedirectResponse
    {
        $this->authorize('update', $hotel);

        $validatedData = $request->validated();
        $this->getHotelService()->update($validatedData, $hotel);

        return redirect()->route(CmsRoutes::CMS_HOTELS_INDEX, ['locale' => $this->locale]);
    }

    public function destroy(Hotel $hotel): RedirectResponse
    {
        $this->authorize('delete', $hotel);

        $this->getHotelService()->delete($hotel);

        return redirect()->route(CmsRoutes::CMS_HOTELS_INDEX, ['locale' => $this->locale]);
    }
}
