<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAgendamentoRequest;
use App\Models\Agendamento;
use App\Models\Servico;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendamentoApiController extends Controller
{
    public function store(CreateAgendamentoRequest $request)
    {
        $clienteId = Auth::id();
        $id_servico = $request->input('id_servico');
        $data = $request->validated();

        $servico = Servico::find($id_servico);

        if (!$servico) {
            return response()->json(['error' => 'Serviço não encontrado.'], 404);
        }

        // ❌ Impede que o prestador agende com ele mesmo
        if ($clienteId === $servico->usuario_id) {
            return response()->json(['error' => 'Você não pode agendar seu próprio serviço.'], 403);
        }

        $agendamento = Agendamento::create([
            'id_cliente'        => $clienteId,
            'id_servico'        => $id_servico,
            'id_prestador'      => $servico->usuario_id,
            'data_agendamento'  => $data['data'],
            'notificacao'       => false,
            'status'            => 4, // status aguardando confirmação
            'descricao'         => $data['descricao'],
        ]);

        return response()->json([
            'message' => 'Agendamento criado com sucesso!',
            'agendamento' => $agendamento
        ], 201);
    }

    public function index()
    {
        $id = Auth::id();

        $agendamentos = Agendamento::with(['prestador', 'servico', 'statusAgendamento'])
            ->where('id_cliente', $id)
            ->get();

        return response()->json([
            'agendamentos' => $agendamentos
        ]);
    }
}
