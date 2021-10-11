<?php

namespace App\Http\Controllers\Cms\Apartments;

use App\Http\Controllers\Cms\Apartments\Requests\UpdateApartmentRequest;
use App\Models\Apartment;
use App\Http\Controllers\Cms\Apartments\Requests\StoreApartmentRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Support\Facades\App;

class CmsApartmentsController extends BaseCmsApartmentsController
{

    public function index(): View
    {
        $apartments = $this->getApartmentService()->getPaginate();

        return view('cms.apartments.index', compact('apartments'));
    }

    public function create(): View
    {
        return view('cms.apartments.create');
    }

    public function store(StoreApartmentRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->getApartmentService()->store($validatedData);

        return redirect()->route(CmsRoutes::CMS_APARTMENTS_INDEX, ['locale' => $this->getLocale()]);
    }

    public function edit(Apartment $apartment): View
    {
        $this->authorize('view', $apartment);

        return view('cms.apartments.edit', compact(['apartment']));
    }

    public function update(UpdateApartmentRequest $request, Apartment $apartment): RedirectResponse
    {
        $this->authorize('update', $apartment);

        $validatedData = $request->validated();
        $this->getApartmentService()->update($validatedData, $apartment);

        return redirect()->route(CmsRoutes::CMS_APARTMENTS_INDEX, ['locale' => $this->getLocale()]);
    }

    public function destroy(Apartment $apartment): RedirectResponse
    {
        $this->authorize('delete', $apartment);
        $this->getApartmentService()->delete($apartment);

        return redirect()->route(CmsRoutes::CMS_APARTMENTS_INDEX, ['locale' => $this->getLocale()]);
    }
}
