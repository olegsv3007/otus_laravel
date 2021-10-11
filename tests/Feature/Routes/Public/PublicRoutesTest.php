<?php

namespace Tests\Feature\Routes\Public;

use App\Models\User;
use Tests\TestCase;
use \Illuminate\Foundation\Testing\RefreshDatabase;

class PublicRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        User::factory()->create();
    }

    /**
     * @test
     */
    public function index_route_return_ok()
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function register_route_return_ok()
    {
        $response = $this->get(route('register'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function user_can_register()
    {
        $registration_data = [
            'name' => 'Username',
            'email' => 'useremail@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $response = $this->post(route('register'), $registration_data);

        $this->assertAuthenticated();
        $response->assertRedirect('/');
    }


    /**
     * @test
     */
    public function login_route_return_ok()
    {
        $response = $this->get(route('login'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function user_can_login()
    {
        $user = User::factory()->create(['email' => 'useremail@example.com']);

        $response = $this->post(route('login'), [
            'email' => 'useremail@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/');

    }

    /**
     * @test
     */
    public function logout_route_return_redirect()
    {
        $this->actingAs(User::all()->random());
        $response = $this->post(route('logout'));

        $response->assertRedirect();
    }



}
