<?php

namespace App\Providers;

use App\Application\Interfaces\AuthServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\EloquentUserRepository;
use App\Infrastructure\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
