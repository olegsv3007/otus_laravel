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

class CmsApartmentRoutesTest extends TestCase
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
                    ->has(Apartment::factory())
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
        $response = $this->get(route(CmsRoutes::CMS_APARTMENTS_INDEX));
        $response
            ->assertOk()
            ->assertViewHas('apartments')
            ->assertViewIs('cms.apartments.index');
    }

    /**
     * @test
     */
    public function cms_apartments_create_route_test()
    {
        $response = $this->get(route(CmsRoutes::CMS_APARTMENTS_CREATE));
        $response
            ->assertOk()
            ->assertViewIs('cms.apartments.create');
    }

    /**
     * @test
     */
    public function cms_apartments_store_route_test()
    {
        Storage::fake('public');
        $filename = Str::random(8) . '.png';
        $hotel = auth()->user()->organization->hotels->random();

        $file = UploadedFile::fake()->image($filename, 128,128);

        $images = [];
        for($i = 0; $i < 5; $i++) {
            $filename = Str::random(8) . '.png';
            $images[] = UploadedFile::fake()->image($filename, 128,128);
        }

        $apartment = Apartment::factory()->make([
            'hotel_id' => $hotel,
            'main_image' => $file,
            'images' => $images,
        ]);

        $response = $this->json('post', route(CmsRoutes::CMS_APARTMENTS_STORE), $apartment->attributesToArray());
        unset($apartment->main_image);
        unset($apartment->images);
        $response->assertRedirect(route(CmsRoutes::CMS_APARTMENTS_INDEX));
        $this->assertDatabaseHas($apartment->getTable(), $apartment->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_apartments_edit_route_test()
    {
        $apartment = auth()->user()->organization->hotels->random()->apartments->random();

        $response = $this->get(route(CmsRoutes::CMS_APARTMENTS_EDIT, $apartment));

        $response
            ->assertOk()
            ->assertViewHas('apartment')
            ->assertSee($apartment->title)
            ->assertViewIs('cms.apartments.edit');
    }

    /**
     * @test
     */
    public function cms_apartments_update_route_test()
    {
        Storage::fake('public');
        $filename = Str::random(8) . '.png';
        $file = UploadedFile::fake()->image($filename, 128,128);
        $hotel = auth()->user()->organization->hotels->random();

        $images = [];
        for($i = 0; $i < 5; $i++) {
            $filename = Str::random(8) . '.png';
            $images[] = UploadedFile::fake()->image($filename, 128,128);
        }

        $oldApartment = $hotel->apartments->random();
        $newApartment = Apartment::factory()->make([
            'hotel_id' => $hotel->id,
            'main_image' => $file,
            'images' => $images,
        ]);

        $response = $this->put(route(CmsRoutes::CMS_APARTMENTS_UPDATE, $oldApartment), $newApartment->attributesToArray());
        unset($newApartment->main_image);
        unset($newApartment->images);
        $response->assertRedirect(route(CmsRoutes::CMS_APARTMENTS_INDEX));
        $this
            ->assertDatabaseHas($newApartment->getTable(), $newApartment->attributesToArray())
            ->assertDatabaseMissing($oldApartment->getTable(), $oldApartment->attributesToArray());
    }

    /**
     * @test
     */
    public function cms_apartments_delete_route_test()
    {
        $apartment = auth()->user()->organization->hotels->random()->apartments->random();

        $response = $this->delete(route(CmsRoutes::CMS_APARTMENTS_DESTROY, $apartment));

        $response->assertRedirect(route(CmsRoutes::CMS_APARTMENTS_INDEX));
        $this->assertSoftDeleted($apartment);
    }

    /**
     * @test
     */
    public function cms_apartments_restore_route_test()
    {
        $apartment = auth()->user()->organization->hotels->random()->apartments->random();
        $apartmentId = $apartment->id;
        $apartment->delete();

        $response = $this->patch(route(CmsRoutes::CMS_APARTMENTS_RESTORE, $apartment));
        $apartment = Hotel::findOrFail($apartmentId);

        $response->assertRedirect(route(CmsRoutes::CMS_APARTMENTS_INDEX));
        $this->assertDatabaseHas($apartment->getTable(), $apartment->attributesToArray());
    }
}
