<?php

namespace App\Http\Controllers;

use App\Application\UseCases\LoginUseCase;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginUseCase $loginUseCase)
    {
        $user = $loginUseCase->execute($request->validated());

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'user' => $user,
        ]);
    }
}
