<?php

namespace App\Providers;

use App\Services\Api\Auth\Abstracts\AuthServiceInterface;
use App\Services\Api\Department\Abstracts\DepartmentServiceInterface;
use App\Services\Api\Auth\AuthService;
use App\Services\Api\Department\DepartmentService;
use App\Services\Api\User\Abstracts\UserServiceInterface;
use App\Services\Api\User\UserService;
use App\Services\Api\Worker\Abstracts\WorkerServiceInterface;
use App\Services\Api\Worker\WorkerService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{

    public array $singletons = [
        AuthServiceInterface::class => AuthService::class,
        DepartmentServiceInterface::class => DepartmentService::class,
        WorkerServiceInterface::class => WorkerService::class,
        UserServiceInterface::class => UserService::class
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
