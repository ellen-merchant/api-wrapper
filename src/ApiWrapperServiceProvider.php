<?php

namespace Ellllllen\ApiWrapper;

use Ellllllen\ApiWrapper\ApiClients\Guzzle;
use Illuminate\Support\ServiceProvider;

class ApiWrapperServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '\config\api-wrapper.php' => config_path('api-wrapper.php')
        ]);
    }

    public function register()
    {
        $this->app->bind(ApiClientInterface::class, Guzzle::class);
    }
}