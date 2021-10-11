<?php

namespace App\Http\Controllers\Cms\Organizations;

use App\Models\Organization;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;

class CmsOrganizationsRestoreController extends BaseCmsOrganizationsController
{

    public function __invoke(Organization $organization): RedirectResponse
    {
        $this->getOrganizationService()->restore($organization);

        return redirect()->route(CmsRoutes::CMS_ORGANIZATIONS_INDEX, ['locale' => $this->getLocale()]);
    }
}
