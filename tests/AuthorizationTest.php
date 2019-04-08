<?php

namespace Yab\FlightDeck\Tests;

use Yab\FlightDeck\FlightDeck;
use Illuminate\Support\Facades\Route;

class AuthorizationTest extends TestCase
{
    /** @test */
    public function valid_authorization_token_allows_request()
    {
        $token = FlightDeck::generate('app1');
        Route::get('authorization-test', function () {
            return response()->json([
                        'data' => 'this was a success',
                    ]);
        })->middleware('flightdeck');

        $response = $this->json('GET', '/authorization-test', [
            'token' => $token,
        ]);
        $response->assertSuccessful();
        $response->assertJson([
            'data' => 'this was a success',
        ]);
    }
    
    /** @test */
    public function authorization_token_must_be_provided_on_routes()
    {
        Route::get('authorization-test', function () {
            return response()->json([
                'data' => 'this was a success',
            ]);
        })->middleware('flightdeck');

        $response = $this->json('GET', '/authorization-test');
        $response->assertForbidden();
    }

    /** @test */
    public function expired_token_is_unauthorized()
    {
        $token = FlightDeck::generate('app2', now()->subDays(2)->toDateTimeString());
        Route::get('authorization-test', function () {
            return response()->json([
                'data' => 'this was a success',
            ]);
        })->middleware('flightdeck');

        $response = $this->json('GET', '/authorization-test', [
            'token' => $token,
        ]);
        $response->assertForbidden();
    }
}
