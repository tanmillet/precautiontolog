<?php
/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/20
 * Time: 16:43
 */

namespace TerryLucasInterFaceLog\Logger;

use Illuminate\Support\ServiceProvider;

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
