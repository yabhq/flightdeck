<?php

namespace Yab\FlightDeck;

use Illuminate\Support\ServiceProvider;
use Yab\FlightDeck\Commands\ListTokens;
use Yab\FlightDeck\Http\Middleware\Cors;
use Yab\FlightDeck\Commands\GenerateToken;
use Yab\FlightDeck\Http\Middleware\Authorization;

class FlightDeckServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'flightdeck');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        
        if (config('flightdeck.authentication.enabled')) {
            $this->loadRoutesFrom(__DIR__ . '/routes/auth.php');
        }

        $this->app['router']->aliasMiddleware('flightdeck', Authorization::class);
        $this->app['router']->aliasMiddleware('cors', Cors::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('flightdeck.php'),
            ], 'config');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/flightdeck'),
            ], 'lang');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'flightdeck');

        $this->commands([
            GenerateToken::class,
            ListTokens::class,
        ]);
    }
}
