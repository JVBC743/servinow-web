<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Usuario;
use App\Models\StatusAgendamento;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAgendamentoRequest;
use App\Services\EvolutionWhatsApp;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();

        $agendamento_cliente = Agendamento::with(['prestador', 'servico', 'statusAgendamento'])
            ->where('id_cliente', $id)
            ->get();

        $agendamento_prestador = Agendamento::with(['cliente', 'servico', 'statusAgendamento'])
            ->where('id_prestador', $id)
            ->get();

        return view('pages.agendamentos', compact('agendamento_cliente', 'agendamento_prestador'));
    }

    public function indexSolicitacoes()
    {
        $id = Auth::id();

        $agendamento = Agendamento::with(['cliente', 'servico', 'statusAgendamento'])
            ->where('id_prestador', $id)
            ->get();

        return view('pages.solicitacoes-agendamento', compact('agendamento'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAgendamentoRequest $request)
    {
        $id = Auth::id();
        $id_servico = $request->input('id_servico');
        $data = $request->validated();

        $servico = Servico::find($id_servico);

        // Impede que o cliente agende com ele mesmo
        if ($servico->usuario_id == $id) {
            return redirect()->back()->with('error', 'Você não pode agendar um serviço com você mesmo.');
        }

        $agendamento = Agendamento::create([
            'id_cliente'        => $id,
            'id_servico'        => $id_servico,
            'id_prestador'      => $servico->usuario_id,
            'data_agendamento'  => $data['data'],
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
        EvolutionWhatsApp::sendMessage('ServiNow', $cliente->telefone, $mensagemCliente);

        // Mensagem para o provedor/prestador
        $mensagemPrestador = "Olá {$prestador->nome}, você recebeu uma nova solicitação de agendamento para o serviço *{$nomeServico}*.\n\n👤 Cliente: {$cliente->nome}\n📞 Contato: {$cliente->telefone}\n📅 Data: *{$dataFormatada}*\n💬 Descrição: {$data['descricao']}\n\nAcesse seu painel para aceitar ou recusar.";
        EvolutionWhatsApp::sendMessage('ServiNow', $prestador->telefone, $mensagemPrestador);

        return redirect()->back()->with('success', 'Solicitação de agendamento enviada com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function acceptSolicitacao(Request $request)
    {
        $id_agendamento = $request->input('id_agendamento');

        if (!$id_agendamento) {
            return redirect()->back()->with('error', 'A solicitação não foi encontrada.');
        }

        $agendamento = Agendamento::find($id_agendamento);

        if (!$agendamento) {
            return redirect()->back()->with('error', 'A solicitação não foi encontrada no banco.');
        }

        $agendamento->update([
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'A solicitação foi aceitada.');
    }

    public function destroySolicitacao(Request $request)
    {

        $id_agendamento = $request->input('id_agendamento');

        if (!$id_agendamento) {
            return redirect()->back()->with('error', 'A solicitação não foi encontrada pela solicitação de exclusão.');
        }

        $agendamento = Agendamento::find($id_agendamento);
        if (!$agendamento) {
            return redirect()->back()->with('error', 'A solicitação não foi encontrada no banco.');
        }

        $agendamento->delete();

        return redirect()->back()->with('success', 'A solicitação foi excluída com sucesso.');
    }

    public function closeFail(Request $request)
    {

        $id_agendamento = $request->input('id_agendamento');

        if (!$id_agendamento) {
            return redirect()->back()->with('error', 'A solicitação não foi encontrada pela solicitação de exclusão.');
        }

        $agendamento = Agendamento::find($id_agendamento);

        if (!$agendamento) {
            return redirect()->back()->with('error', 'A solicitação não foi encontrada no banco.');
        }

        $agendamento->update([
            'status' => 4,
        ]);

        return redirect()->back()->with('success', 'O agendamento foi fechado com o status: Fechado sem sucesso.');
    }

    public function closeSuccess(Request $request)
    {

        $id_agendamento = $request->input('id_agendamento');

        if (!$id_agendamento) {
            return redirect()->back()->with('error', 'A solicitação não foi encontrada pela solicitação de exclusão.');
        }

        $agendamento = Agendamento::find($id_agendamento);

        if (!$agendamento) {
            return redirect()->back()->with('error', 'A solicitação não foi encontrada no banco.');
        }

        $agendamento->update([
            'status' => 3,
        ]);

        return redirect()->back()->with('success', 'O agendamento foi fechado com o status: Fechado com sucesso.');
    }
}
