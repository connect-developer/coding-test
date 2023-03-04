<?php

namespace App\Providers;

use App\Core\Contract\IService;
use App\Services\AuthService;
use App\Services\BaseService;
use App\Services\Contracts\IAuthService;
use App\Services\Contracts\IJobService;
use App\Services\Contracts\IUserService;
use App\Services\JobService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IService::class, BaseService::class);
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IJobService::class, JobService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
