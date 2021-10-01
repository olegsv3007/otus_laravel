<?php

namespace Tests\Feature\Routes\Cms;

use App\Models\Apartment;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Organization;
use App\Models\User;
use App\Models\Role;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class CmsHotelRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $organization = Organization::factory()->create();

        $managerRole = Role::where('name', User::ROLE_MANAGER)->get();
        $manager = User::factory()->hasAttached($managerRole)->create(['organization_id' => $organization->id]);

        Country::factory()
            ->count(1)
            ->has(City::factory()
                ->count(1)
                ->has(Hotel::factory()
                    ->count(1)
                    ->sequence(fn () => ['organization_id' => $organization->id])
                )
            )
            ->create();

        $this->actingAs($manager);
    }

    /**
     * @test
     */
    public function cms_hotels_index_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_HOTELS_INDEX));
        $response
            ->assertOk()
            ->assertViewHas('hotels')
            ->assertViewIs('cms.hotels.index');
    }

    /**
     * @test
     */
    public function cms_hotels_create_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_HOTELS_CREATE));
        $response
            ->assertOk()
            ->assertViewIs('cms.hotels.create');
    }

    /**
     * @test
     */
    public function cms_hotels_store_route_test()
    {
        Storage::fake('public');
        $filename = Str::random(8) . '.png';
        $file = UploadedFile::fake()->image($filename, 128,128);
        $hotel = Hotel::factory()->make([
            'city_id' => City::all()->random()->id,
            'main_image' => $file,
        ]);

        $response = $this->json('post', route(CmsRoutes::CMS_HOTELS_STORE), $hotel->attributesToArray());
        unset($hotel->main_image);

        $response->assertRedirect(route(CmsRoutes::CMS_HOTELS_INDEX));
        $this->assertDatabaseHas($hotel->getTable(), $hotel->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_hotels_edit_route_test()
    {
        $hotel = auth()->user()->organization->hotels->random();

        $response = $this->get(route(CmsRoutes::CMS_HOTELS_EDIT, $hotel));

        $response
            ->assertOk()
            ->assertViewHas('hotel')
            ->assertSee($hotel->name)
            ->assertViewIs('cms.hotels.edit');
    }

    /**
     * @test
     */
    public function cms_hotels_update_route_test()
    {
        Storage::fake('public');
        $filename = Str::random(8) . '.png';
        $file = UploadedFile::fake()->image($filename, 128,128);

        $oldHotel = auth()->user()->organization->hotels->random();
        $newHotel = Hotel::factory()->make([
            'city_id' => City::all()->random()->id,
            'main_image' => $file,
        ]);

        $response = $this->put(route(CmsRoutes::CMS_HOTELS_UPDATE, $oldHotel), $newHotel->attributesToArray());

        unset($newHotel->main_image);
        $response->assertRedirect(route(CmsRoutes::CMS_HOTELS_INDEX));
        $this
            ->assertDatabaseHas($newHotel->getTable(), $newHotel->attributesToArray())
            ->assertDatabaseMissing($oldHotel->getTable(), $oldHotel->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_hotels_delete_route_test()
    {
        $hotel = auth()->user()->organization->hotels->random();

        $response = $this->delete(route(CmsRoutes::CMS_HOTELS_DESTROY, $hotel));

        $response->assertRedirect(route(CmsRoutes::CMS_HOTELS_INDEX));
        $this->assertSoftDeleted($hotel);
    }

    /**
     * @test
     */
    public function cms_hotels_restore_route_test()
    {
        $hotel = auth()->user()->organization->hotels->random();
        $hotelId = $hotel->id;
        $hotel->delete();

        $response = $this->patch(route(CmsRoutes::CMS_HOTELS_RESTORE, $hotel));
        $hotel = Hotel::findOrFail($hotelId);

        $response->assertRedirect(route(CmsRoutes::CMS_HOTELS_INDEX));
        $this->assertDatabaseHas($hotel->getTable(), $hotel->attributesToArray());
    }
}
