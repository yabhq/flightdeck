<?php

namespace Yab\FlightDeck\Tests;

use Illuminate\Http\Response;
use Yab\FlightDeck\Models\User;
use Yab\FlightDeck\Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class ForgotPasswordTest extends TestCase
{
    /** @test */
    public function an_email_is_required_to_send_password_reset_email()
    {
        $response = $this->post(route('password.email'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonStructure([
            'errors' => [
                'email',
            ]
        ]);
    }

    /** @test */
    public function entering_a_valid_email_address_sends_the_forgot_password_email()
    {
        Notification::fake();

        $user = factory(User::class)->create();

        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        $response->assertOk();

        Notification::assertSentTo($user, ResetPassword::class);
    }
}

