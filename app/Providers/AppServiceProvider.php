<?php

namespace App\Providers;

use App\Application\Interfaces\AuthServiceInterface;
use App\Domain\Repositories\FormacaoRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Infrastructure\Persistence\EloquentUsuarioRepository;
use App\Infrastructure\Persistence\FormacaoRepository;
use App\Infrastructure\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsuarioRepositoryInterface::class, EloquentUsuarioRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(FormacaoRepositoryInterface::class, FormacaoRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
