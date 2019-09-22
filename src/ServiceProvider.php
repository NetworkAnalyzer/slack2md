<?php

namespace Nojiri1098\LaravelMultiAuth;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Nojiri1098\LaravelMultiAuth\Console\Commands\MakeMultiAuth;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(MakeMultiAuth::class);
    }
}
