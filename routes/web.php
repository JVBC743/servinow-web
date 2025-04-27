<?php

use Illuminate\Support\Facades\Route;

Route::view('/login', 'pages.login')->name('login');
Route::view('/cadastro', 'pages.cadastro')->name('cadastro');
Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
Route::view('/perfil/editar', 'pages.edicao-perfil')->name('edicao-perfil');
Route::view('/perfil', 'pages.visualizacao-perfil')->name('visualizacao-perfil');
Route::view('/usuarios', 'pages.lista-usuarios')->name('lista-usuarios');
Route::view('/sobre-nos', 'pages.sobre-nos')->name('sobre-nos');
Route::view('/termos', 'pages.termos-uso-privacidade')->name('termos');
Route::view('/avaliacoes', 'pages.lista-avaliacao-servicos')->name('lista-avaliacoes');