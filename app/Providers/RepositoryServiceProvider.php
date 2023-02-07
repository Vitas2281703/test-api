<?php

namespace App\Providers;

use App\Repositories\Department\Abstracts\DepartmentRepositoryInterface;
use App\Repositories\Department\DepartmentRepositoryEloquent;
use App\Repositories\User\Abstracts\UserRepositoryInterface;
use App\Repositories\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UserRepositoryInterface::class => UserRepositoryEloquent::class,
        DepartmentRepositoryInterface::class => DepartmentRepositoryEloquent::class,
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
