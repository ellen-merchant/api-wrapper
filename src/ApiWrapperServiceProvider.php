<?php

namespace Ellllllen\ApiWrapper;

use Illuminate\Support\ServiceProvider;

class ApiWrapperServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '\config\api-wrapper.php' => config_path('api-wrapper.php')
        ]);
    }
}