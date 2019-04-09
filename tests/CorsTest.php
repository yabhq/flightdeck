<?php

namespace Yab\FlightDeck\Tests;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yab\FlightDeck\Models\User;
use Yab\FlightDeck\Tests\TestCase;
use Yab\FlightDeck\Http\Middleware\Cors;

class CorsTest extends TestCase
{
    /** @test */
    public function cors_headers_are_set()
    {
        $response = \Mockery::Mock(Response::class)
            ->shouldReceive('header')
            ->with('Access-Control-Allow-Origin', '*')
            ->shouldReceive('header')
            ->with('Access-Control-Allow-Methods', 'HEAD, GET, PUT, PATCH, POST')
            ->getMock();

        $request = Request::create(route('login'), 'POST');

        $middleware = new Cors;

        $middleware->handle($request, function () use ($response) {
            return $response;
        });
    }
}
