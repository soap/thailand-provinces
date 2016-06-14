<?php

namespace Soap\ThProvinces;

use Soap\ThProvinces\Provinces\Provinces;
use Illuminate\Support\ServiceProvider;

class ProvincesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/thprovinces.php' => config_path('thprovinces.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/Config/thprovinces.php', 'ThProvinces');
        $this->app['ThProvinces'] = $this->app->share(function($app) {
            return new Provinces;
        });    }
}
