<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (! $usuario || ! Hash::check($request->password, $usuario->senha)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais estão incorretas.'],
            ]);
        }

        $token = $usuario->createToken('api_token')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'token'   => $token,
        ]);
    }

    public function register(UserRegisterRequest $request)
    {
        $usuario = Usuario::create([
            'nome' => $request->nome,
            'senha' => Hash::make($request->password),
            'telefone' => $request->telefone,
            'email' => $request->email,
            'cpf_cnpj' => $request->cpf_cnpj,
            'data_nascimento' => $request->data_nascimento,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
        ]);

        $token = $usuario->createToken('api_token')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'token' => $token,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
