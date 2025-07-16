@extends('layouts.autenticado')

@section('title', 'Solicitações')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 1200px">

            <h1 class="text-center mb-4">Solicitações de agendamento pelos seus serviços</h1>

            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Solicitante</th>
                        <th>Serviço</th>
                        <th>Data/Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agendamento as $item)
                        @if($item->id_prestador == auth()->id() && $item->statusAgendamento->status == 'Aguardando confirmação')

                            <tr class="text-align-center">
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->id_cliente ? $item->cliente->nome : 'Cliente inexistente.'}} </td>
                                <td> {{ $item->id_servico ? $item->servico->nome_servico : 'Serviço inexistente.'}} </td>
                                <td> {{ $item->data_agendamento }} </td>
                                <td class="d-flex justify-content-between">
                                    {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                    <div>
                                        <img data-bs-toggle="modal" data-bs-target="#modalSolicitacao{{ $item->id }}" class="list_icons border border-black rounded" src="{{ asset('images/verificar.png') }}" alt="">
                                        <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                            <img class="list_icons" src="{{ asset('images/redirecionar.png') }}" alt="">
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalSolicitacao{{ $item->id }}" tabindex="-1" aria-labelledby="modalSolicitacaoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <input type="hidden" name="id_servico" value="{{ $item->id_servico}}">
                                        <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalAgendamentoLabel">Nova Solicitação</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <h1>Solicitante:</h1>
                                                <h2>
                                                    {{ $item->id_cliente ? $item->cliente->nome : 'Cliente inexistente.' }}
                                                </h2>
                                            </div>

                                            <div class="mb-3">
                                                <label for="comentario" class="form-label">Descrição</label>
                                                <h3>
                                                    {{ $item->descricao }}
                                                </h3>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <form action="{{ route('aceitacao.solicitacao') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                                <button name="aceitar">
                                                    <img class="list_icons" src="{{ asset('images/confirmar.png') }}" alt="Botão para aceitar a solicitação de agendamento.">
                                                </button>
                                            </form>
    
                                            <form action="{{ route('negacao.solicitacao') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                                <button name="negar">
                                                    <img class="list_icons" data-bs-dismiss="modal" src="{{ asset('images/negar.png') }}" alt="Botão para negar a solicitação de agendamento">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
