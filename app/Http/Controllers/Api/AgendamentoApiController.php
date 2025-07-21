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
        $id = Auth::id();
        $id_servico = $request->input('id_servico');
        $data = $request->validated();

        $servico = \App\Models\Servico::find($id_servico);

        // Impede que o cliente agende com ele mesmo
        if ($servico->usuario_id == $id) {
            return response()->json(['error' => 'Você não pode agendar um serviço com você mesmo.'], 403);
        }

        $agendamento = \App\Models\Agendamento::create([
            'id_cliente'        => $id,
            'id_servico'        => $id_servico,
            'id_prestador'      => $servico->usuario_id,
            'prazo'             => $data['data'],
            'notificacao'       => false,
            'status'            => 1,
            'descricao'         => $data['descricao'],
        ]);

        $cliente = Auth::user();
        $prestador = $servico->prestador; // Assumindo que $servico->prestador retorna o usuário dono do serviço
        $nomeServico = $servico->nome_servico;
        $dataFormatada = \Carbon\Carbon::parse($data['data'])->format('d/m/Y H:i');

        // Mensagem para o cliente
        $mensagemCliente = "Olá {$cliente->nome}, sua solicitação de agendamento para o serviço *{$nomeServico}* foi enviada com sucesso!\n\n📅 Data: *{$dataFormatada}*\n💬 Descrição: {$data['descricao']}\n\nEm breve o prestador entrará em contato.";
        \App\Services\EvolutionWhatsApp::sendMessage('ServiNow', $cliente->telefone, $mensagemCliente);

        // Mensagem para o provedor/prestador
        $mensagemPrestador = "Olá {$prestador->nome}, você recebeu uma nova solicitação de agendamento para o serviço *{$nomeServico}*.\n\n👤 Cliente: {$cliente->nome}\n📞 Contato: {$cliente->telefone}\n📅 Data: *{$dataFormatada}*\n💬 Descrição: {$data['descricao']}\n\nAcesse seu painel para aceitar ou recusar.";
        \App\Services\EvolutionWhatsApp::sendMessage('ServiNow', $prestador->telefone, $mensagemPrestador);

        return response()->json([
            'message' => 'Solicitação de agendamento enviada com sucesso!',
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
