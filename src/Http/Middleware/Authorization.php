<?php

namespace Yab\FlightDeck\Http\Middleware;

use Closure;
use Yab\FlightDeck\FlightDeck;
use Illuminate\Auth\Access\AuthorizationException;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('flightdeck.authorization.enabled')) {
            if (FlightDeck::checkToken($request->header(config('flightdeck.authorization.header')))) {
                return $next($request);
            }
            throw new AuthorizationException('You have provided an invalid api token.');
        }
        return $next($request);
    }
}
