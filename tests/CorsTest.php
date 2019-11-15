<?php

namespace Yab\FlightDeck\Tests;

use Illuminate\Http\Response;
use Yab\FlightDeck\Models\User;
use Yab\FlightDeck\Tests\TestCase;
use Illuminate\Support\Facades\Route;
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

    /** @test */
    public function cors_origin_header_can_be_customized()
    {
        config(['flightdeck.cors.origin' => 'testdomain.org']);
        $response = $this->getTestResponse();
        $this->assertCorsHeadersSet($response, 'testdomain.org');
    }

    /** @test */
    public function cors_methods_header_can_be_customized()
    {
        config(['flightdeck.cors.methods' => 'GET, POST, PUT, PATCH']);
        $response = $this->getTestResponse();
        $this->assertCorsHeadersSet($response, '*', 'GET, POST, PUT, PATCH');
    }

    /**
     * Assert the CORS headers are set correctly
     *
     * @param Illuminate\Foundation\Testing\TestResponse $response
     * @return void
     */
    private function assertCorsHeadersSet(TestResponse $response, $origin = '*', $methods = null)
    {
        $methods = $methods ?? 'GET, POST, OPTIONS, PUT, PATCH, DELETE';
        $response
            ->assertHeader('Access-Control-Allow-Origin', $origin)
            ->assertHeader('Access-Control-Allow-Methods', $methods)
            ->assertHeader('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, Cache-Control, X-Requested-With');
    }

    /**
     * Stub out a route for testing CORS endpoints
     *
     * @return Illuminate\Foundation\Testing\TestResponse $response
     */
    private function getTestResponse()
    {
        Route::get('180cd62d-3c17-42cb-a13e-e318d312afff', function () {
            return 'hello cors';
        })->middleware(['cors']);
        return $this->get('180cd62d-3c17-42cb-a13e-e318d312afff');
    }
}
