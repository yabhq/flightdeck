<?php

namespace Yab\FlightDeck\Tests;

use Illuminate\Http\Response;
use Yab\FlightDeck\Models\User;
use Yab\FlightDeck\Tests\TestCase;

class CorsTest extends TestCase
{
    /** @test */
    public function cors_headers_are_set_for_login_route()
    {
        $this
            ->post(route('login'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertHeader('Access-Control-Allow-Origin', '*')
            ->assertHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
            ->assertHeader('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, Cache-Control, X-Requested-With');
    }
}
