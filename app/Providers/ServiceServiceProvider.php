<?php

namespace App\Providers;

use App\Services\Api\Auth\Abstracts\AuthServiceInterface;
use App\Services\Api\Auth\AuthService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{

    public array $singletons = [
        AuthServiceInterface::class => AuthService::class,
    ];
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
        //
    }
}
