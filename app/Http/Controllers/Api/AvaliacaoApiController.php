<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAvaliacaoRequest;
use App\Models\Avaliacao;
use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliacaoApiController extends Controller
{
    public function store(CreateAvaliacaoRequest $request)
    {
        $data = $request->validated();
        $userId = auth()->id();

        $servico = Servico::find($data['id_servico']);

        if (!$servico) {
            return response()->json(['error' => 'Serviço não encontrado.'], 404);
        }

        // Impede que o próprio prestador avalie seu serviço
        if ($servico->usuario_id === $userId) {
            return response()->json(['error' => 'Você não pode avaliar seu próprio serviço.'], 403);
        }

        $data['id_cliente'] = $userId;

        $avaliacao = Avaliacao::create($data);

        return response()->json([
            'message' => 'Avaliação inserida com sucesso!',
            'avaliacao' => $avaliacao
        ], 201);
    }

    public function update(CreateAvaliacaoRequest $request, $id)
    {
        $avaliacao = Avaliacao::find($id);

        if (!$avaliacao) {
            return response()->json(['error' => 'Avaliação não encontrada.'], 404);
        }

        if ($avaliacao->id_cliente !== Auth::id()) {
            return response()->json(['error' => 'Você não tem permissão para editar esta avaliação.'], 403);
        }

        $avaliacao->update($request->validated());

        return response()->json([
            'message' => 'Avaliação atualizada com sucesso!',
            'avaliacao' => $avaliacao
        ]);
    }

    public function destroy($id)
    {
        $avaliacao = Avaliacao::find($id);

        if (!$avaliacao) {
            return response()->json(['error' => 'Avaliação não encontrada.'], 404);
        }

        if ($avaliacao->id_cliente !== Auth::id()) {
            return response()->json(['error' => 'Você não tem permissão para excluir esta avaliação.'], 403);
        }

        $avaliacao->delete();

        return response()->json(['message' => 'Avaliação excluída com sucesso.']);
    }

    public function listar($servico_id)
    {
        $avaliacoes = Avaliacao::where('id_servico', $servico_id)
            ->with('cliente')
            ->orderByDesc('created_at')
            ->get();

        return response()->json($avaliacoes);
    }
}
