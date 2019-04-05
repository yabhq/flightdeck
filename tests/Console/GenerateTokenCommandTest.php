<?php

namespace Yab\FlightDeck\Tests;

use Yab\FlightDeck\Tests\TestCase;

class GenerateTokenCommandTest extends TestCase
{
    /** @test */
    public function generate_a_token_from_command_line()
    {
        $this->artisan('flightdeck:generate', ['name' => 'app1'])
                ->assertExitCode(0);
    }
}
