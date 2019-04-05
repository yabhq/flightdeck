<?php

namespace Yab\FlightDeck\Tests;

use Illuminate\Http\Response;
use Yab\FlightDeck\Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    /** @test */
    public function an_email_is_required_to_send_password_reset_email()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->post(route('password.email'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}

