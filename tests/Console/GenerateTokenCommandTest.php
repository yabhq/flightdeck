<?php

namespace Yab\FlightDeck\Tests;

use Yab\FlightDeck\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class GenerateTokenCommandTest extends TestCase
{
    #[Test]
    public function generate_a_token_from_command_line()
    {
        $this->artisan('flightdeck:generate', ['name' => 'app1'])
                ->assertExitCode(0);
    }
}
