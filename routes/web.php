<?php

use App\Http\Controllers\AgendamentoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicoController;

/*
|--------------------------------------------------------------------------
| Rotas públicas (sem autenticação)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login e cadastro
    Route::view('/login', 'pages.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('loginPost');

    Route::prefix('cadastro')->controller(AuthController::class)->group(function () {
        Route::view('/', 'pages.cadastro')->name('cadastro.form');
        Route::post('/', 'register')->name('cadastro.store');
    });
});

// Informações públicas
Route::view('/avaliacoes', 'pages.lista-avaliacao-servicos')->name('lista-avaliacoes');
Route::view('/sobre-nos', 'pages.sobre-nos')->name('sobre.nos');
Route::view('/termos', 'pages.termos-uso-privacidade')->name('termos');

/*
|--------------------------------------------------------------------------
| Rotas protegidas (usuário autenticado)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard e perfil
    // Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
    Route::view('/perfil', 'pages.visualizacao-perfil')->name('visualizacao-perfil');


    Route::prefix('agendamento')->controller(AgendamentoController::class)->group(function () {
        Route::get('cliente', 'indexCliente')->name('agendamento.cliente');
        Route::get('prestador', 'indexPrestador')->name('agendamento.prestador');
    });
    
    // Perfil do usuário
    Route::prefix('perfil')->controller(UsuarioController::class)->group(function () {
        Route::get('/lista', 'index')->name('lista');
        Route::get('/edicao/{id}', 'show')->name('mostrar.edicao');
        Route::get('/formacoes/{id}', 'listFormations')->name('listar.formacoes');
        Route::put('/editar/{id}', 'edit')->name('editar.usuario');
        Route::delete('/excluir/{id}', 'destroy')->name('excluir.conta');
    });

    // Serviços
    Route::prefix('servico')->controller(ServicoController::class)->group(function () {
        Route::get('/', 'index')->name('servico.index');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::view('/teste', 'pages.servico')->name('servico'); //ROTA DE TESTE PARA A VIEW DE SERVIÇO
        Route::get('/create', 'create')->name('servico.create');
        Route::post('/', 'store')->name('servico.store');
        Route::get('/{servico}', 'show')->name('servico.show');
        Route::get('/{servico}/edit', 'edit')->name('servico.edit');
        Route::put('/{servico}', 'update')->name('servico.update');
        Route::delete('/{servico}', 'destroy')->name('servico.destroy');
    });

    // Testes e uploads
    Route::controller(UsuarioController::class)->group(function () {
        Route::get('/teste-minio', 'showMinioTest');
        Route::post('/teste-minio', 'testeMinio')->name('enviar.imagem');
    });

    // Admin
    Route::middleware('can:is_admin')->prefix('admin')->controller(UsuarioController::class)->group(function () {
        Route::get('/usuarios', 'index')->name('admin.lista.usuarios');
        Route::get('/edicao/{id}', 'adminShowUserAccount')->name('admin.mostrar.edicao');
        Route::put('/editar/{id}', 'adminUsuarioEdit')->name('admin.usuario.edit');
        Route::delete('/excluir/{id}', 'adminUserDestroy')->name('admin.excluir.conta');
    });
});
