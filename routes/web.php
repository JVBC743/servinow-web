<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::view('/login', 'pages.login')->name('login');
Route::view('/cadastro', 'pages.cadastro')->name('cadastro');
Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
Route::view('/perfil', 'pages.visualizacao-perfil')->name('visualizacao-perfil');
Route::view('/avaliacoes', 'pages.lista-avaliacao-servicos')->name('lista-avaliacoes');

Route::get('/sobre-nos', function(){

    return view('pages/sobre-nos');

})->name('sobre.nos');

Route::get('/termos', function(){

    return view('pages/termos-uso-privacidade');

})->name('termos');




Route::get('/lista', [UsuarioController::class, 'index'])->name('lista');
Route::get('/edicao-perfil/{id}', [UsuarioController::class, 'show'])->name('mostrar.edicao');//Mudar essa rota quando for implementado o login.
Route::put('/edicao-perfil/{id}', [UsuarioController::class ,'edit'])->name('editar.usuario');
Route::get('/edicao-perfil/{id}', [UsuarioController::class, 'listFormations'])->name('listar.forrmacoes');



Route::post('/cadastro-servico', [ServicoController::class , 'store'])->name('cadastro.servico.store');

// Route::put('/cadastro-servico/{id}', [ServicoController::class , 'edit'])->name('cadastro.servico.edit');

Route::get('/cadastro-servico', function(){
    return view('pages/cadastro-servico');
})->name('cadastro.servico');

Route::get('/edicao-servico', function(){
    return view('pages/edicao-servico');
})->name('edicao.servico');



Route::get('/', function () {
    return view('welcome');
});