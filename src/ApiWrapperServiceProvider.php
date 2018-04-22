<?php

namespace Ellllllen\ApiWrapper;

use Illuminate\Support\ServiceProvider;
use Ellllllen\ApiWrapper\ApiClients\Contracts\ApiClientRequestInterface;
use Ellllllen\ApiWrapper\ApiClients\Contracts\ApiClientInterface;
use Ellllllen\ApiWrapper\ApiClients\Guzzle;

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
        $this->app->bind(ApiClientRequestInterface::class, Guzzle::class);
        $this->app->bind(ApiClientInterface::class, Guzzle::class);
    }
}