<?php

namespace App\Http\Controllers;

use App\Application\DTOs\RegisterUsuarioDTO;
use App\Application\UseCases\RegisterUsuarioUseCase;
use App\Http\Requests\RegisterUsuarioRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(RegisterUsuarioRequest $request, RegisterUsuarioUseCase $useCase): JsonResponse
    {
        $dto = new RegisterUsuarioDTO(
            nome: $request->input('nome'),
            email: $request->input('email'),
            senha: $request->input('senha'),
            telefone: $request->input('telefone'),
            cpf_cnpj: $request->input('cpf_cnpj'),
            area_atuacao_id: (int) $request->input('area_atuacao_id')
        );

        $usuario = $useCase->execute($dto);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'usuario' => [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'telefone' => $usuario->telefone,
                'cpf_cnpj' => $usuario->cpf_cnpj,
                'area_atuacao' => $usuario->area_atuacao->id,
            ],
        ], 201);
    }
}
