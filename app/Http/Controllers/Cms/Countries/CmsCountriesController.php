<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Http\Controllers\Cms\Countries\Requests\StoreCountryRequest;
use App\Models\Country;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CmsCountriesController extends BaseCmsCountriesController
{
    public function index(): View
    {
        $countries = $this->getCountryService()->getPaginate();

        return view('cms.countries.index', compact(['countries']));
    }

    public function create(): View
    {
        return view('cms.countries.create');
    }

    public function store(StoreCountryRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->getCountryService()->store($validatedData);

        return redirect()->route(CmsRoutes::CMS_COUNTRIES_INDEX, ['locale' => $this->locale]);

    }

    public function edit(Country $country): View
    {
        return view('cms.countries.edit', compact(['country']));
    }

    public function update(StoreCountryRequest $request, Country $country): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->getCountryService()->update($validatedData, $country);

        return redirect()->route(CmsRoutes::CMS_COUNTRIES_INDEX, ['locale' => $this->locale]);
    }

    public function destroy(Country $country): RedirectResponse
    {
        $this->getCountryService()->delete($country);

        return redirect()->route(CmsRoutes::CMS_COUNTRIES_INDEX, ['locale' => $this->locale]);
    }
}
