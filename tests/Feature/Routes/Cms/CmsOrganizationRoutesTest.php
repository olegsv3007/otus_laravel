<?php

namespace Tests\Feature\Routes\Cms;

use App\Models\City;
use App\Models\Country;
use App\Models\Organization;
use App\Models\User;
use App\Models\Role;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsOrganizationRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Organization::factory()
            ->count(10)
            ->create();

        $adminRole = Role::where('name', User::ROLE_ADMIN)->get();
        $admin = User::factory()->hasAttached($adminRole)->create();

        $this->actingAs($admin);
    }

    /**
     * @test
     */
    public function cms_organizations_index_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_ORGANIZATIONS_INDEX));
        $response
            ->assertOk()
            ->assertViewHas('organizations')
            ->assertViewIs('cms.organizations.index');
    }

    /**
     * @test
     */
    public function cms_organizations_create_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_ORGANIZATIONS_CREATE));
        $response
            ->assertOk()
            ->assertViewIs('cms.organizations.create');
    }

    /**
     * @test
     */
    public function cms_organizations_store_route_test()
    {
        $organization = Organization::factory()->make();

        $response = $this->post(route(CmsRoutes::CMS_ORGANIZATIONS_STORE), $organization->attributesToArray());

        $response->assertRedirect(route(CmsRoutes::CMS_ORGANIZATIONS_INDEX));
        $this->assertDatabaseHas($organization->getTable(), $organization->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_organizations_edit_route_test()
    {
        $organization = Organization::all()->random();

        $response = $this->get(route(CmsRoutes::CMS_ORGANIZATIONS_EDIT, $organization->id));

        $response
            ->assertOk()
            ->assertViewHas('organization')
            ->assertSee($organization->name)
            ->assertViewIs('cms.organizations.edit');
    }

    /**
     * @test
     */
    public function cms_organizations_update_route_test()
    {
        $oldOrganization = Organization::all()->random();
        $newOrganization = Organization::factory()->make();

        $response = $this->put(route(CmsRoutes::CMS_ORGANIZATIONS_UPDATE, $oldOrganization->id), $newOrganization->attributesToArray());

        $response->assertRedirect(route(CmsRoutes::CMS_ORGANIZATIONS_INDEX));
        $this
            ->assertDatabaseHas($newOrganization->getTable(), $newOrganization->attributesToArray())
            ->assertDatabaseMissing($oldOrganization->getTable(), $oldOrganization->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_organizations_delete_route_test()
    {
        $organization = Organization::all()->first();
        $response = $this->delete(route(CmsRoutes::CMS_ORGANIZATIONS_DESTROY, $organization->id));

        $response->assertRedirect(route(CmsRoutes::CMS_ORGANIZATIONS_INDEX));
        $this->assertSoftDeleted($organization);
    }

    /**
     * @test
     */
    public function cms_organizations_restore_route_test()
    {
        $organization = Organization::all()->first();
        $organizationId = $organization->id;
        $organization->delete();

        $response = $this->patch(route(CmsRoutes::CMS_ORGANIZATIONS_RESTORE, $organizationId));
        $organization = Organization::findOrFail($organizationId);

        $response->assertRedirect(route(CmsRoutes::CMS_ORGANIZATIONS_INDEX));
        $this->assertDatabaseHas($organization->getTable(), $organization->attributesToArray());
    }
}
