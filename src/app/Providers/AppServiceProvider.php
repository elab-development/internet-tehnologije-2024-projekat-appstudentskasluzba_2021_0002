<?php

namespace App\Providers;

use App\Application\Repositories\PredmetRepositoryInterface;
use App\Application\Repositories\StudentRepositoryInterface;
use App\Infrastructure\Repositories\EloquentPredmetRepository;
use App\Infrastructure\Repositories\EloquentStudentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PredmetRepositoryInterface::class, EloquentPredmetRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, EloquentStudentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
