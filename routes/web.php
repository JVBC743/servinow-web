<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServicoController;

Route::view('/login', 'pages.login')->name('login');
Route::view('/dashboard', 'pages.dashboard')->name('dashboard');

// --- REMOVA ESTA LINHA ANTIGA ---
// Route::view('/cadastro', 'pages.cadastro')->name('cadastro');

// --- ADICIONE ESTAS DUAS NOVAS ROTAS PARA O CADASTRO ---
// Rota GET: Apenas MOSTRA o formulário de cadastro.
Route::view('/cadastro', 'pages.cadastro')->name('cadastro.form');

// Rota POST: PROCESSA os dados do formulário, enviando para o seu Controller.
Route::post('/cadastro', [RegisterController::class, 'store'])->name('cadastro.store');
// --- FIM DAS ADIÇÕES ---

Route::view('/perfil', 'pages.visualizacao-perfil')->name('visualizacao-perfil');

Route::view('/avaliacoes', 'pages.lista-avaliacao-servicos')->name('lista-avaliacoes');

Route::get('/sobre-nos', function(){
    return view('pages/sobre-nos');
})->name('sobre.nos');

Route::get('/termos', function(){
    return view('pages/termos-uso-privacidade');
})->name('termos');

Route::get('/lista', [UsuarioController::class, 'index'])->name('lista');
//Mudar essa rota quando for implementado o login.

Route::put('/editar-perfil/{id}', [UsuarioController::class ,'edit'])->name('editar.usuario');

Route::get('/edicao-perfil/{id}', [UsuarioController::class, 'show'])->name('mostrar.edicao');

Route::get('/edicao-perfil/{id}', [UsuarioController::class, 'listFormations'])->name('listar.forrmacoes');

Route::delete('/edicao-perfil/{id}', [UsuarioController::class, 'destroy'])->name('excluir.conta');


Route::post('/cadastro-servico', [ServicoController::class , 'create'])->name('cadastro.servico.create');

// Route::put('/cadastro-servico/{id}', [ServicoController::class , 'edit'])->name('cadastro.servico.edit');

Route::get('/cadastro-servico', function(){
    return view('pages/cadastro-servico');
})->name('cadastro.servico');

Route::get('/edicao-servico', function(){
    return view('pages/edicao-servico');
})->name('edicao.servico');

Route::get('/admin-lista-usuarios', [UsuarioController::class, 'index'])->name('admin.lista.usuarios');

Route::get('/admin-edicao-perfil/{id}', [UsuarioController::class, 'adminShowUserAccount'])->name('admin.mostrar.edicao');

Route::put('/admin-editar-perfil/{id}', [UsuarioController::class, 'adminUsuarioEdit'])->name('admin.usuario.edit');

Route::delete('/admin-excluir-conta/{id}', [UsuarioController::class, 'adminUserDestroy'])->name('admin.excluir.conta');


Route::get('/teste-minio', [UsuarioController::class, 'showMinioTest']);

Route::post('/teste-minio', [UsuarioController::class, 'testeMinio'])->name('enviar.imagem');

Route::get('/', function () {
    return view('welcome');
});
