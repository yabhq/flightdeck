<?php

namespace Yab\FlightDeck\Http\Middleware;

use Closure;
use Yab\FlightDeck\FlightDeck;
use Illuminate\Auth\Access\AuthorizationException;

class Cors
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
        var_dump("there");
        $content = $next($request);

        if (method_exists($content, 'header')) {
            return $content
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
                ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, Cache-Control, X-Requested-With');
        }

        return $content;
    }
}