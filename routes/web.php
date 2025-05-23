<?php

use Illuminate\Support\Facades\Route;

Route::view('/login', 'pages.login')->name('login');
Route::view('/cadastro', 'pages.cadastro')->name('cadastro');
Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
Route::view('/perfil/editar', 'pages.edicao-perfil')->name('edicao-perfil');
Route::view('/perfil', 'pages.visualizacao-perfil')->name('visualizacao-perfil');
Route::view('/avaliacoes', 'pages.lista-avaliacao-servicos')->name('lista-avaliacoes');

Route::get('/sobre-nos', function(){

    return view('pages/sobre-nos');

})->name('sobre.nos');

Route::get('/termos', function(){

    return view('pages/termos-uso-privacidade');

})->name('termos');

Route::get('/lista', function(){

    return view('pages/lista-usuarios');

})->name('lista');


Route::get('/', function () {
    return view('welcome');
});