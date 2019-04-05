<?php

namespace Yab\FlightDeck\Http\Controllers;

use Illuminate\Routing\Controller;
use Yab\FlightDeck\Http\Resources\UserResource;

class UsersController extends Controller
{
    /**
     * Display the resource
     *
     * @return Illuminate\Http\Response
     */
    public function show()
    {
        return new UserResource(auth()->user());
    }
}
