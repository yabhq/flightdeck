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
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (FlightDeck::checkToken($request->token)) {
            return $next($request);
        }
        throw new AuthorizationException('You have provided an invalid api token.');
    }
}
