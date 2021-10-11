<?php

namespace Tests\Feature\Routes\Cms;

use App\Models\Country;
use App\Models\User;
use App\Models\Role;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsCountryRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $adminRole = Role::where('name', User::ROLE_ADMIN)->get();
        $admin = User::factory()->hasAttached($adminRole)->create();

        Country::factory()->count(10)->create();

        $this->actingAs($admin);
    }

    /**
     * @test
     */
    public function cms_counties_index_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_COUNTRIES_INDEX));
        $response
            ->assertOk()
            ->assertViewHas('countries')
            ->assertViewIs('cms.countries.index');
    }

    /**
     * @test
     */
    public function cms_counties_create_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_COUNTRIES_CREATE));
        $response
            ->assertOk()
            ->assertViewIs('cms.countries.create');
    }

    /**
     * @test
     */
    public function cms_counties_store_route_test()
    {
        $country = Country::factory()->make();

        $response = $this->post(route(CmsRoutes::CMS_COUNTRIES_STORE), $country->attributesToArray());

        $response->assertRedirect(route(CmsRoutes::CMS_COUNTRIES_INDEX));
        $this->assertDatabaseHas($country->getTable(), $country->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_counties_edit_route_test()
    {
        $country = Country::all()->random();

        $response = $this->get(route(CmsRoutes::CMS_COUNTRIES_EDIT, $country->id));
        $response
            ->assertOk()
            ->assertViewHas('country')
            ->assertSee($country->name)
            ->assertViewIs('cms.countries.edit');
    }

    /**
     * @test
     */
    public function cms_counties_update_route_test()
    {
        $oldCountry = Country::all()->random();
        $newCountry = Country::factory()->make()->attributesToArray();

        $response = $this->put(route(CmsRoutes::CMS_COUNTRIES_UPDATE, $oldCountry->id), $newCountry);

        $response->assertRedirect(route(CmsRoutes::CMS_COUNTRIES_INDEX));
        $this
            ->assertDatabaseHas($oldCountry->getTable(), $newCountry)
            ->assertDatabaseMissing($oldCountry->getTable(), $oldCountry->toArray());
    }

    /**
     * @test
     */
    public function cms_counties_delete_route_test()
    {
        $country = Country::all()->first();
        $response = $this->delete(route(CmsRoutes::CMS_COUNTRIES_DESTROY, $country->id));

        $response->assertRedirect(route(CmsRoutes::CMS_COUNTRIES_INDEX));
        $this->assertSoftDeleted($country);
    }

    /**
     * @test
     */
    public function cms_counties_restore_route_test()
    {
        $country = Country::all()->first();
        $countryId = $country->id;
        $country->delete();

        $response = $this->patch(route(CmsRoutes::CMS_COUNTRIES_RESTORE, $countryId));
        $country = Country::findOrFail($countryId);

        $response->assertRedirect(route(CmsRoutes::CMS_COUNTRIES_INDEX));
        $this->assertDatabaseHas($country->getTable(), $country->attributesToArray());
    }
}
