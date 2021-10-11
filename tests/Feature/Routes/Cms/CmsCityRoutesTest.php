<?php

namespace Tests\Feature\Routes\Cms;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\Role;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsCityRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $adminRole = Role::where('name', User::ROLE_ADMIN)->get();
        $admin = User::factory()->hasAttached($adminRole)->create();

        Country::factory()
            ->count(10)
            ->hasCities(3)
            ->create();

        $this->actingAs($admin);
    }

    /**
     * @test
     */
    public function cms_cities_index_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_CITIES_INDEX));
        $response
            ->assertOk()
            ->assertViewHas('cities')
            ->assertViewIs('cms.cities.index');
    }

    /**
     * @test
     */
    public function cms_cities_create_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_CITIES_CREATE));
        $response
            ->assertOk()
            ->assertViewIs('cms.cities.create');
    }

    /**
     * @test
     */
    public function cms_cities_store_route_test()
    {
        $countryId = Country::all()->random()->id;
        $city = City::factory()->make([
            'country_id' => $countryId
        ]);

        $response = $this->post(route(CmsRoutes::CMS_CITIES_STORE), $city->attributesToArray());

        $response->assertRedirect(route(CmsRoutes::CMS_CITIES_INDEX));
        $this->assertDatabaseHas($city->getTable(), $city->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_cities_edit_route_test()
    {
        $city = City::all()->random();

        $response = $this->get(route(CmsRoutes::CMS_CITIES_EDIT, $city->id));
        $response
            ->assertOk()
            ->assertViewHas('city')
            ->assertSee($city->name)
            ->assertViewIs('cms.cities.edit');
    }

    /**
     * @test
     */
    public function cms_cities_update_route_test()
    {
        $oldCity = City::all()->random();
        $newCity = City::factory()->make([
            'country_id' => $oldCity->country_id,
        ]);

        $response = $this->put(route(CmsRoutes::CMS_CITIES_UPDATE, $oldCity->id), $newCity->attributesToArray());

        $response->assertRedirect(route(CmsRoutes::CMS_CITIES_INDEX));
        $this
            ->assertDatabaseHas($newCity->getTable(), $newCity->attributesToArray())
            ->assertDatabaseMissing($oldCity->getTable(), $oldCity->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_cities_delete_route_test()
    {
        $city = City::all()->first();

        $response = $this->delete(route(CmsRoutes::CMS_CITIES_DESTROY, $city->id));

        $response->assertRedirect(route(CmsRoutes::CMS_CITIES_INDEX));
        $this->assertSoftDeleted($city);
    }

    /**
     * @test
     */
    public function cms_cities_restore_route_test()
    {
        $city = City::all()->first();
        $cityId = $city->id;
        $city->delete();

        $response = $this->patch(route(CmsRoutes::CMS_CITIES_RESTORE, $cityId));
        $city = City::findOrFail($cityId);

        $response->assertRedirect(route(CmsRoutes::CMS_CITIES_INDEX));
        $this->assertDatabaseHas($city->getTable(), $city->attributesToArray());
    }
}
