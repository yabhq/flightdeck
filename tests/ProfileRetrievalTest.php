<?php

namespace Yab\FlightDeck\Tests;

use Yab\FlightDeck\Models\User;
use Yab\FlightDeck\Tests\TestCase;

class ProfileRetrievalTest extends TestCase
{
    /** @test */
    public function an_authorized_user_can_retrieve_their_profile()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->json('POST', '/me');
        $response->assertStatus(200);
        $response->assertJsonFragment([
        	'data' => [
        		'name' => $user->name,
        		'email' => $user->email,
        	]
        ]);
    }
}

