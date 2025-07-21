<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Usuario;
use App\Models\StatusAgendamento;
use App\Models\Agendamento;
use App\Models\Categoria;
use App\Models\Pagamento;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAgendamentoRequest;
use App\Services\EvolutionWhatsApp;
use App\Services\FakePaymentGateway;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();

        // Serviços agendados como prestador
        $agendamento_prestador = Agendamento::with(['cliente', 'servico', 'statusAgendamento'])
            ->where('id_prestador', $id)
            ->where('status', '!=', 1)
            ->get();

        // Serviços agendados como cliente
        $agendamento_cliente = Agendamento::with(['prestador', 'servico', 'statusAgendamento'])
            ->where('id_cliente', $id)
            ->get();

        // Serviços agendados (solicitações)
        $agendamento = Agendamento::with(['cliente', 'servico', 'statusAgendamento'])
            ->where('id_prestador', $id)
            ->get();

        // Serviços cadastrados
        $servicos = Servico::where('usuario_id', $id)->get();

        // Categorias (ADICIONE ESTA LINHA)
        $categorias = Categoria::all();

        return view('pages.agendamentos', compact(
            'agendamento_prestador',
            'agendamento_cliente',
            'agendamento',
            'servicos',
            'categorias' // ADICIONE ESTA VARIÁVEL
        ));
    }

    public function indexSolicitacoes()
    {
        $id = Auth::id();

        $agendamento = Agendamento::with(['cliente', 'servico', 'statusAgendamento'])
            ->where('id_prestador', $id)
            ->get();

        // $agendamento->prazo = \Carbon\Carbon::createFromFormat('d/m/Y', $data)->format('Y-m-d');

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
            'prazo'  => $data['data'],
            'notificacao'       => false,
            'status'            => 1,
            'descricao'         => $data['descricao'],
        ]);

        $cliente = Auth::user();
        $prestador = $servico->prestador;
        $nomeServico = $servico->nome_servico;
        $dataFormatada = \Carbon\Carbon::parse($data['data'])->format('d/m/Y H:i');

        // Mensagem para o cliente
        $mensagemCliente = "Olá {$cliente->nome}, sua solicitação de agendamento para o serviço *{$nomeServico}* foi enviada com sucesso!\n\n📅 Data: *{$dataFormatada}*\n💬 Descrição: {$data['descricao']}\n\nEm breve o prestador entrará em contato.";
        EvolutionWhatsApp::sendMessage('ServiNow', $cliente->telefone, $mensagemCliente);

        // Mensagem para o prestador
        $mensagemPrestador = "Olá {$prestador->nome}, você recebeu uma nova solicitação de agendamento para o serviço *{$nomeServico}*.\n\n👤 Cliente: {$cliente->nome}\n📞 Contato: {$cliente->telefone}\n📅 Data: *{$dataFormatada}*\n💬 Descrição: {$data['descricao']}\n\nAcesse seu painel para aceitar ou recusar.";
        EvolutionWhatsApp::sendMessage('ServiNow', $prestador->telefone, $mensagemPrestador);

        return redirect()->route('agendamento.cliente')->with('success', 'Agendamento solicitado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function showBoleto(string $id)
    {
        $pagamento = Pagamento::where('codigo', $id)->firstOrFail();

        $amount = $pagamento->agendamento->servico->preco ?? 0;
        $codigo = $pagamento->codigo;
        $barcode = '23790.12345 60000.123456 70000.123456 1 12340000010000';
        $qr_code = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate(route('fake.payment.boleto.pagar', ['id' => $codigo]));

        return view('pages.boleto', compact('amount', 'codigo', 'barcode', 'qr_code'));
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
            return redirect()->route('agendamento.cliente')->with('error', 'A solicitação não foi encontrada pela solicitação de aceitação.');
        }

        $agendamento = Agendamento::find($id_agendamento);

        if (!$agendamento) {
            return redirect()->route('agendamento.cliente')->with('error', 'A solicitação não foi encontrada no banco.');
        }

        $agendamento->update([
            'status' => 2,
        ]);

        $cliente = Usuario::find($agendamento->id_cliente);
        $prestador = Usuario::find($agendamento->id_prestador);
        $nomeServico = $agendamento->servico->nome_servico;
        $dataFormatada = \Carbon\Carbon::parse($agendamento->prazo)->format('d/m/Y H:i');

        // Mensagem para o cliente
        $mensagemCliente = "Olá {$cliente->nome}, sua solicitação de agendamento para o serviço *{$nomeServico}* foi aceita pelo prestador!\n\n👤 Prestador: {$prestador->nome}\n📞 Contato: {$prestador->telefone}\n📅 Data: *{$dataFormatada}*\n\nO prestador entrará em contato em breve.";
        EvolutionWhatsApp::sendMessage('ServiNow', $cliente->telefone, $mensagemCliente);

        return redirect()->route('agendamento.cliente')->with('success', 'A solicitação foi aceita com sucesso.');
    }

    public function denySolicitacao(Request $request)
    {
        $id_agendamento = $request->input('id_agendamento');

        if (!$id_agendamento) {
            return redirect()->route('agendamento.cliente')->with('error', 'A solicitação não foi encontrada pela solicitação de exclusão.');
        }

        $agendamento = Agendamento::find($id_agendamento);

        if (!$agendamento) {
            return redirect()->route('agendamento.cliente')->with('error', 'A solicitação não foi encontrada no banco.');
        }

        $cliente = Usuario::find($agendamento->id_cliente);
        $prestador = Usuario::find($agendamento->id_prestador);
        $nomeServico = $agendamento->servico->nome_servico;
        $dataFormatada = \Carbon\Carbon::parse($agendamento->prazo)->format('d/m/Y H:i');

        // Mensagem para o cliente
        $mensagemCliente = "Olá {$cliente->nome}, infelizmente sua solicitação de agendamento para o serviço *{$nomeServico}* foi recusada pelo prestador.\n\n📅 Data solicitada: *{$dataFormatada}*\n\nTente encontrar outro prestador ou remarque para outra data.";
        EvolutionWhatsApp::sendMessage('ServiNow', $cliente->telefone, $mensagemCliente);

        $agendamento->delete();

        return redirect()->route('agendamento.cliente')->with('success', 'A solicitação foi negada com sucesso.');
    }

    public function fecharSucesso(Request $request)
    {
        $id_agendamento = $request->input('id_agendamento');

        if (!$id_agendamento) {
            return redirect()->route('agendamento.cliente')->with('error', 'A solicitação não foi encontrada pela solicitação de exclusão.');
        }

        $agendamento = Agendamento::find($id_agendamento);

        if (!$agendamento) {
            return redirect()->route('agendamento.cliente')->with('error', 'A solicitação não foi encontrada no banco.');
        }
        if ($agendamento->status != 2) {
            return redirect()->route('agendamento.cliente')->with('error', 'Só é possível finalizar agendamentos em andamento.');
        }
        // Valida se já foi finalizado
        if (in_array($agendamento->status, [3, 4])) {
            return redirect()->route('agendamento.cliente')->with('error', 'Este agendamento já foi finalizado.');
        }

        $agendamento->update([
            'status' => 3,
        ]);

        // Mensagem para o cliente
        $cliente = Usuario::find($agendamento->id_cliente);
        $prestador = Usuario::find($agendamento->id_prestador);
        $nomeServico = $agendamento->servico->nome_servico;
        $dataFormatada = \Carbon\Carbon::parse($agendamento->prazo)->format('d/m/Y H:i');

        $mensagemCliente = "Olá {$cliente->nome}, o serviço *{$nomeServico}* foi finalizado com sucesso!\n\n👤 Prestador: {$prestador->nome}\n📅 Data: *{$dataFormatada}*\n\nNão esqueça de avaliar o serviço em nosso sistema.";
        EvolutionWhatsApp::sendMessage('ServiNow', $cliente->telefone, $mensagemCliente);

        return redirect()->route('agendamento.cliente')->with('success', 'O agendamento foi finalizado com sucesso.');
    }

    public function fecharFalha(Request $request)
    {
        $id_agendamento = $request->input('id_agendamento');

        if (!$id_agendamento) {
            return redirect()->route('agendamento.cliente')->with('error', 'A solicitação não foi encontrada pela solicitação de exclusão.');
        }

        $agendamento = Agendamento::find($id_agendamento);

        if (!$agendamento) {
            return redirect()->route('agendamento.cliente')->with('error', 'A solicitação não foi encontrada no banco.');
        }
        if ($agendamento->status != 2) {
            return redirect()->route('agendamento.cliente')->with('error', 'Só é possível finalizar agendamentos em andamento.');
        }
        // Valida se já foi finalizado
        if (in_array($agendamento->status, [3, 4])) {
            return redirect()->route('agendamento.cliente')->with('error', 'Este agendamento já foi finalizado.');
        }

        $agendamento->update([
            'status' => 4,
        ]);

        // Mensagem para o cliente
        $cliente = Usuario::find($agendamento->id_cliente);
        $prestador = Usuario::find($agendamento->id_prestador);
        $nomeServico = $agendamento->servico->nome_servico;
        $dataFormatada = \Carbon\Carbon::parse($agendamento->prazo)->format('d/m/Y H:i');

        $mensagemCliente = "Olá {$cliente->nome}, o agendamento do serviço *{$nomeServico}* foi finalizado sem sucesso.\n\n👤 Prestador: {$prestador->nome}\n📅 Data: *{$dataFormatada}*\n\nEntre em contato conosco se precisar de assistência.";
        EvolutionWhatsApp::sendMessage('ServiNow', $cliente->telefone, $mensagemCliente);

        return redirect()->route('agendamento.cliente')->with('success', 'O agendamento foi finalizado.');
    }

    public function confirmarPagamento(Request $request)
    {
        $id_agendamento = $request->input('id_agendamento');

        if (!$id_agendamento) {
            return redirect()->back()->with('error', 'Agendamento não encontrado.');
        }

        $pagamento = Pagamento::where('id_agendamento', $id_agendamento)->first();

        if (!$pagamento) {
            return redirect()->back()->with('error', 'Pagamento não encontrado para este agendamento.');
        }

        $gateway = new FakePaymentGateway();
        $gateway->confirmPayment($pagamento->codigo);

        // Atualize o status do agendamento, se necessário
        $agendamento = $pagamento->agendamento;
        if ($agendamento) {
            $agendamento->update(['status' => 2]); // Exemplo: 2 = "Em progresso"
        }

        return redirect()->back()->with('success', 'Pagamento confirmado com sucesso!');
    }

    public function pagarBoletoFake($id)
    {
        $pagamento = \App\Models\Pagamento::where('codigo', $id)->firstOrFail();

        $gateway = new \App\Services\FakePaymentGateway();
        $gateway->confirmPayment($pagamento->codigo);

        // (Opcional) Atualize o status do agendamento, se desejar
        if ($pagamento->agendamento) {
            $pagamento->agendamento->update(['status' => 6]); // Exemplo: 6 = "Pago"
        }

        return response()->json([
            'success' => true,
            'message' => 'Pagamento confirmado com sucesso!',
        ]);
        // Ou, se preferir, redirecione para uma página de sucesso:
        // return redirect()->route('fake.payment.boleto', ['id' => $id])->with('success', 'Pagamento confirmado!');
    }
}
