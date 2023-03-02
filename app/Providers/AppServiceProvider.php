<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Job\IJobRepository;
use App\Repositories\Job\JobRepository;

use App\Services\Job\IJobService;
use App\Services\Job\JobService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Services
        $this->app->bind(IJobService::class, JobService::class);


        //Repositories
        $this->app->bind(IJobRepository::class, JobRepository::class);
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
