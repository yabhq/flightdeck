<?php

namespace Yab\FlightDeck\Tests;

use Illuminate\Http\Response;
use Yab\FlightDeck\Models\User;
use Yab\FlightDeck\Tests\TestCase;
use Illuminate\Foundation\Testing\TestResponse;

class CorsTest extends TestCase
{
    /** @test */
    public function cors_headers_are_set_for_login_route()
    {
        $response = $this->post(route('login'));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertCorsHeadersSet($response);
    }

    /** @test */
    public function cors_headers_are_set_for_logout_route()
    {
        $response = $this->post(route('logout'));
        $response->assertOk();

        $this->assertCorsHeadersSet($response);  
    }

    /** @test */
    public function cors_headers_are_set_for_me_route()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->post(route('me'));
        $response->assertOk();

        $this->assertCorsHeadersSet($response);  
    }

    /**
     * Assert the CORS headers are set correctly
     *
     * @param Illuminate\Foundation\Testing\TestResponse $response
     * @return void
     */
    private function assertCorsHeadersSet(TestResponse $response)
    {
        $response
            ->assertHeader('Access-Control-Allow-Origin', '*')
            ->assertHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
            ->assertHeader('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, Cache-Control, X-Requested-With');
    }
}
