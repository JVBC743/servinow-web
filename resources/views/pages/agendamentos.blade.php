@extends('layouts.autenticado')

@section('title', 'Agendamentos')

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

            <h1 class="text-center mb-4">Seus serviços agendados como cliente</h1>

            <div class="table-responsive table-scroll-vertical">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Prestador</th>
                            <th>Serviço</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendamento_cliente as $item)
                            <tr class="text-align-center">
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->id_prestador ? $item->prestador->nome : 'Prestador inexistente.'}} </td>
                                <td> {{ $item->id_servico ? $item->servico->nome_servico : 'Serviço inexistente.'}} </td>
                                <td> {{ $item->data_agendamento->format('d/m/Y') }} </td>
                                @if($item->status != 4)
                                    <td class="d-flex justify-content-between">
                                        {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                        <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                            <img class="list_icons" src="{{ asset('images/redirecionar.png') }}" alt="">
                                        </a>
                                    </td>
                                @else
                                    <td class="d-flex justify-content-between">
                                        {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                        <div>
                                            <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                                <img class="list_icons" src="{{ asset('images/redirecionar.png') }}" alt="">
                                            </a>
                                            <img class="list_icons" src="{{ asset('images/ampulheta.png') }}"
                                                alt="Olho aberto, símbolo de verificação de solicitação de agendamento.">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <small class="d-md-none text-muted">Deslize para o lado para ver mais →</small>
            </div>

            <h1 class="text-center mb-4">Seus serviços agendados como prestador</h1>
            <div class="table-responsive table-scroll-vertical">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Serviço</th>
                            <th>Data</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendamento_prestador as $item)
                            <tr class="text-align-center">
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->id_cliente ? $item->cliente->nome : 'Cliente inexistente.'}} </td>
                                <td> {{ $item->id_servico ? $item->servico->nome_servico : 'Serviço inexistente.'}} </td>
                                <td> {{ $item->data_agendamento->format('d/m/Y') }} </td>
                                @if($item->status != 4)
                                    <td class="d-flex justify-content-between">
                                        {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                        <div>
                                            <img  data-bs-toggle="modal" data-bs-target="#modalAgendamento{{ $item->id }}" class="list_icons" src="{{ asset("images/menu.png") }}" alt="">
                                            <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                                <img class="list_icons" src="{{ asset('images/redirecionar.png') }}" alt="">
                                            </a>
                                        </div>
                                    </td>
                                @else
                                    <td class="d-flex justify-content-between">
                                        {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                        <div>
                                            <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                                <img class="list_icons" src="{{ asset('images/redirecionar.png') }}" alt="">
                                            </a>
                                            <img class="list_icons" src="{{ asset('images/ampulheta.png') }}"
                                                alt="Olho aberto, símbolo de verificação de solicitação de agendamento.">
                                        </div>
                                    </td>
                                @endif
                            </tr>

                            <div class="modal fade" id="modalAgendamento{{ $item->id }}" tabindex="-1" aria-labelledby="modalAgendamentoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        {{-- <input type="hidden" name="id_servico" value="{{ $item->id_servico}}"> --}}
                                        <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalAgendamentoLabel">Opções</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                Alterar estado do serviço: {{ $item->servico->nome_servico }}
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-success">
                                                Confirmar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    <small class="d-md-none text-muted">Deslize para o lado para ver mais →</small>
                </table>
            </div>
        </div>
    </div>
@endsection


                                