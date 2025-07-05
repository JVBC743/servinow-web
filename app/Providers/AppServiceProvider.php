<?php

namespace App\Providers;

use App\Application\Interfaces\AuthServiceInterface;
use App\Application\Interfaces\StorageServiceInterface;
use App\Domain\Repositories\FormacaoRepositoryInterface;
use App\Domain\Repositories\ServicoRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Infrastructure\Persistence\EloquentServicoRepository;
use App\Infrastructure\Persistence\EloquentUsuarioRepository;
use App\Infrastructure\Persistence\FormacaoRepository;
use App\Infrastructure\Services\AuthService;
use App\Infrastructure\Persistence\EloquentServicoRepository;
use App\Domain\Repositories\ServicoRepositoryInterface;
use App\Infrastructure\Services\MinioStorageService;

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
        $this->app->bind(ServicoRepositoryInterface::class, EloquentServicoRepository::class);



        $this->app->bind(StorageServiceInterface::class, MinioStorageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
