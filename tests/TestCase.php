<?php

namespace Yab\FlightDeck\Tests;

use Yab\FlightDeck\Models\User;
use Illuminate\Support\Facades\Artisan;
use Yab\FlightDeck\FlightDeckServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/../src/database/factories');

        $this->loadMigrationsFrom(__DIR__ . '/../src/database/migrations');

        Artisan::call('migrate', [
            '--database' => 'testbench',
        ]);
    }

    /**
     * Get the package providers array.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            FlightDeckServiceProvider::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('auth.providers.users.model', User::class);
    }
}
