<?php

namespace Yab\FlightDeck\Controllers;

use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    /**
     * Display the resource
     *
     * @return Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json([
			'data' => [
	    		'name' => auth()->user()->name,
                'email' => auth()->user()->email,
	    	]
		]);
    }

}
