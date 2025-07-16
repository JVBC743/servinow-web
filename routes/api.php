<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\AgendamentoApiController;
use App\Http\Controllers\Api\AvaliacaoApiController;

Route::prefix('v1')->group(function () {

    // 🔹 Rota de teste de conexão
    Route::get('/ping', function () {
        return response()->json(['message' => 'pong']);
    });

    // Autenticação via token
    Route::post('/login', [AuthApiController::class, 'login']);
    Route::post('/register', [AuthApiController::class, 'register']);

    // Rotas protegidas
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/agendamentos', [AgendamentoApiController::class, 'index']);
        Route::post('/agendamentos', [AgendamentoApiController::class, 'store']);

        Route::get('/avaliacoes/{servico_id}', [AvaliacaoApiController::class, 'listar']);
        Route::post('/avaliacoes', [AvaliacaoApiController::class, 'store']);

        Route::post('/logout', [AuthApiController::class, 'logout']);
    });

});

