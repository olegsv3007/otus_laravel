<?php

namespace App\Http\Controllers\Cms\Cities;

use App\Http\Controllers\Cms\Cities\Requests\StoreCityRequest;
use App\Models\City;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CmsCitiesController extends BaseCmsCitiesController
{
    public function index(): View
    {
        $cities = $this->getCityService()->getPaginate();

        return view('cms.cities.index', compact(['cities']));
    }

    public function create(): View
    {
        return view('cms.cities.create');
    }

    public function store(StoreCityRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->getCityService()->store($validatedData);

        return redirect()->route(CmsRoutes::CMS_CITIES_INDEX);
    }

    public function edit(City $city): View
    {
        return view('cms.cities.edit', compact(['city']));
    }

    public function update(StoreCityRequest $request, City $city): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->getCityService()->update($validatedData, $city);

        return redirect()->route(CmsRoutes::CMS_CITIES_INDEX);
    }

    public function destroy(City $city): RedirectResponse
    {
        $this->getCityService()->delete($city);

        return redirect()->route(CmsRoutes::CMS_CITIES_INDEX);
    }
}
