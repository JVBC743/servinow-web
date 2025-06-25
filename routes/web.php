<?php

use Illuminate\Support\Facades\Route;
// --- ADICIONE ESTA LINHA ---
use App\Http\Controllers\Auth\RegisterController;

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

Route::view('/perfil/editar', 'pages.edicao-perfil')->name('edicao-perfil');
Route::view('/perfil', 'pages.visualizacao-perfil')->name('visualizacao-perfil');
Route::view('/usuarios', 'pages.lista-usuarios')->name('lista-usuarios');

Route::get('/sobre-nos', function(){
    return view('pages/sobre-nos');
})->name('sobre.nos');

Route::get('/termos', function(){
    return view('pages/termos-uso-privacidade');
})->name('termos');

Route::view('/avaliacoes', 'pages.lista-avaliacao-servicos')->name('lista-avaliacoes');

Route::get('/', function () {
    return view('welcome');
});
