<?php

namespace Slps970093\Live100ms;

use Illuminate\Support\ServiceProvider;
use Slps970093\Live100ms\Auth\AppToken;
use Slps970093\Live100ms\Auth\ManagementToken;

class Live100msServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'live100ms');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'live100ms');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('live100ms.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/live100ms'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/live100ms'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/live100ms'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'live100ms');

        // Register the main class to use with the facade
        $this->app->singleton('live100ms', function () {
            return new Live100ms();
        });

        $this->app->singleton(AppToken::class, function () {
            return new AppToken(
                config('100ms.access_token', ""),
                config('100ms.secret', ""),
                config('100ms.api-version', 2),
            );
        });

        $this->app->singleton(ManagementToken::class, function () {
            return new ManagementToken(
                config('100ms.access_token', ""),
                config('100ms.secret', ""),
                config('100ms.api-version', 2),
            );
        });
    }
}
