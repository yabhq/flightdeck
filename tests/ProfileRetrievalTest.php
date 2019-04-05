<?php

namespace Yab\FlightDeck\Tests;

use Illuminate\Http\Response;
use Yab\FlightDeck\Models\User;
use Yab\FlightDeck\Tests\TestCase;

class ProfileRetrievalTest extends TestCase
{
    /** @test */
    public function an_authorized_user_can_retrieve_their_profile()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->json('GET', '/me');
        
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
        	'data' => [
        		'name' => $user->name,
        		'email' => $user->email,
        	]
        ]);
    }

    /** @test */
    public function a_guest_cannot_retrieve_their_profile()
    {
        $response = $this->json('GET', '/me');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}

