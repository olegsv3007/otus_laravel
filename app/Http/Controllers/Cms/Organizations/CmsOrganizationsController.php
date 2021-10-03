<?php

namespace App\Http\Controllers\Cms\Organizations;

use App\Http\Controllers\Cms\Organizations\Requests\StoreOrganizationRequest;
use App\Models\Organization;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CmsOrganizationsController extends BaseCmsOrganizationsController
{

    public function index(): View
    {
        $organizations = $this->getOrganizationService()->getPaginate();

        return view('cms.organizations.index', compact(['organizations']));
    }

    public function create(): View
    {
        return view('cms.organizations.create');
    }

    public function store(StoreOrganizationRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->getOrganizationService()->store($validatedData);

        return redirect()->route(CmsRoutes::CMS_ORGANIZATIONS_INDEX, ['locale' => $this->locale]);
    }

    public function edit(Organization $organization): View
    {
        return view('cms.organizations.edit', compact(['organization']));
    }

    public function update(StoreOrganizationRequest $request, Organization $organization): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->getOrganizationService()->update($validatedData, $organization);

        return redirect()->route(CmsRoutes::CMS_ORGANIZATIONS_INDEX, ['locale' => $this->locale]);
    }

    public function destroy(Organization $organization): RedirectResponse
    {
        $this->getOrganizationService()->delete($organization);

        return redirect()->route(CmsRoutes::CMS_ORGANIZATIONS_INDEX, ['locale' => $this->locale]);
    }
}
