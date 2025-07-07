<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServicoController;

// Autenticação
Route::view('/login', 'pages.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('cadastro')->controller(AuthController::class)->group(function () {
    Route::view('/', 'pages.cadastro')->name('cadastro.form');
    Route::post('/', 'register')->name('cadastro.store');
});

Route::view('/servico/teste', 'pages.servico')->name('servico');


// Dashboard e perfil
Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
Route::view('/perfil', 'pages.visualizacao-perfil')->name('visualizacao-perfil');

// Informações públicas
Route::view('/avaliacoes', 'pages.lista-avaliacao-servicos')->name('lista-avaliacoes');
Route::view('/sobre-nos', 'pages.sobre-nos')->name('sobre.nos');
Route::view('/termos', 'pages.termos-uso-privacidade')->name('termos');

// Usuário (perfil pessoal)
Route::prefix('perfil')->controller(UsuarioController::class)->group(function () {
    Route::get('/lista', 'index')->name('lista');

    Route::get('/edicao/{id}', 'show')->name('mostrar.edicao');
    Route::get('/formacoes/{id}', 'listFormations')->name('listar.formacoes');

    Route::put('/editar/{id}', 'edit')->name('editar.usuario');
    Route::delete('/excluir/{id}', 'destroy')->name('excluir.conta');
});

// Serviço
Route::prefix('servico')->controller(ServicoController::class)->group(function () {
    Route::get('/', 'index')->name('servico.index');                   // Lista todos os serviços
    Route::get('/create', 'create')->name('servico.create');          // Formulário de cadastro
    Route::post('/', 'store')->name('servico.store');                 // Salva novo serviço
    Route::get('/{servico}', 'show')->name('servico.show');          // Detalhes de um serviço
    Route::get('/{servico}/edit', 'edit')->name('servico.edit');     // Formulário de edição
    Route::put('/{servico}', 'update')->name('servico.update');      // Atualiza serviço
    Route::delete('/{servico}', 'destroy')->name('servico.destroy'); // Exclui serviço

});

// Admin
Route::prefix('admin')->controller(UsuarioController::class)->group(function () {
    Route::get('/usuarios', 'index')->name('admin.lista.usuarios');
    Route::get('/edicao/{id}', 'adminShowUserAccount')->name('admin.mostrar.edicao');
    Route::put('/editar/{id}', 'adminUsuarioEdit')->name('admin.usuario.edit');
    Route::delete('/excluir/{id}', 'adminUserDestroy')->name('admin.excluir.conta');
});

// Testes e uploads
Route::controller(UsuarioController::class)->group(function () {
    Route::get('/teste-minio', 'showMinioTest');
    Route::post('/teste-minio', 'testeMinio')->name('enviar.imagem');
});
