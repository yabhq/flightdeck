<?php

namespace Yab\FlightDeck\Tests;

use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Yab\FlightDeck\Models\User;
use Yab\FlightDeck\Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordTest extends TestCase
{
    /** @test */
    public function an_email_password_and_token_are_required()
    {
        $response = $this->post(route('password.reset'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonStructure([
            'errors' => [
                'email',
                'password',
                'token',
            ]
        ]);
    }

    /** @test */
    public function a_password_must_be_confirmed()
    {
        $response = $this->post(route('password.reset'), [
            'token' => Str::random(32),
            'email' => 'johnsnow@yabhq.com',
            'password' => 'supersecret',
            'password_confirmation' => 'notsupersecret',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonStructure([
            'errors' => [
                'password',
            ]
        ]);
    }

    /** @test */
    public function providing_valid_information_results_in_successful_password_reset()
    {
        $user = factory(User::class)->create();

        $token = Password::broker()->createToken($user);

        $response = $this->post(route('password.reset'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'supersecret',
            'password_confirmation' => 'supersecret',
        ]);

        $response->assertOk();

        $user = $user->fresh();

        $this->assertTrue(Hash::check('supersecret', $user->password));
    }
}
