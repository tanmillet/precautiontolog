<?php

namespace TerryLucasInterFaceLog\Logger;

use Illuminate\Support\ServiceProvider;

/**
 * Class TerryLucasLoggerProvider
 * User: Terry Lucas
 * @package TerryLucasInterFaceLog\Logger
 */
class TerryLucasLoggerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('preer', function () {
            return new Precaution();
        });
    }
}
