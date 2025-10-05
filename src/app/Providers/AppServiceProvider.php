<?php

namespace App\Providers;

use App\Application\Repositories\PredmetRepositoryInterface;
use App\Infrastructure\Repositories\EloquentPredmetRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PredmetRepositoryInterface::class, EloquentPredmetRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
