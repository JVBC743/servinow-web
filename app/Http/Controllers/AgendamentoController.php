<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Usuario;
use App\Models\StatusAgendamento;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAgendamentoRequest;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function indexPrestador()
    // {
    //     $id = Auth::id();

    //     $prestador = Usuario::find($id); //auth
    //     $agendamento = Agendamento::with(['cliente', 'servico', 'statusAgendamento'])
    //         ->where('id_prestador', $prestador->id)
    //         ->get();
    //     return view('pages.agendamento-prestador', compact('prestador', 'agendamento'));

    // }

    public function indexCliente()
    {
        $id = Auth::id();

        $cliente = Usuario::find($id); //auth
        $agendamento = Agendamento::with(['prestador', 'servico', 'statusAgendamento'])
            ->where('id_cliente', $cliente->id)
            ->get();

        return view('pages.agendamento-cliente', compact('cliente', 'agendamento'));
    }

    public function indexSolicitacoes(){
        $id = Auth::id();
        $agendamento = Agendamento::with(['cliente', 'servico', 'statusAgendamento'])
            ->where('id_prestador', $id)
            ->get();

        return view('pages.solicitacoes-agendamento', compact('agendamento'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAgendamentoRequest $request)
    {
        $id = Auth::id();
        $id_servico = $request->input('id_servico');
        $data = $request->validated();

        $servico = Servico::find($id_servico);

        Agendamento::create([
            'id_cliente'        => $id,
            'id_servico'        => $id_servico,
            'id_prestador'      => $servico->usuario_id,
            'data_agendamento'  => $data['data'],
            'notificacao'       => false,
            'status'            => 4,
            'descricao'         => $data['descricao'],
        ]);
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
}
