@extends('layouts.autenticado')

@section('title', 'Agendamentos')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 1200px">

            <h1 class="text-center mb-4">Seus serviços agendados como cliente</h1>

            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Prestador</th>
                        <th>Serviço</th>
                        <th>Data/Hora</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agendamento as $item)
                        <tr class="text-align-center">
                            <td> {{ $item->id }} </td>
                            <td> {{ $item->id_prestador ? $item->prestador->nome : 'Cliente inexistente.'}} </td>
                            <td> {{ $item->id_servico ? $item->servico->nome_servico : 'Serviço inexistente.'}} </td>
                            <td> {{ $item->data_agendamento }} </td>
                            @if($item->status != 4)
                                <td class="d-flex justify-content-between">
                                    {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                    <img class="list_icons" src="{{ asset('images/redirecionar.png') }}" alt="">
                                </td>
                            @else
                                <td class="d-flex justify-content-between">
                                    {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                     <img data-bs-toggle="modal" data-bs-target="#modalAgendamento" class="list_icons ms-1 border border-black rounded" src="{{ asset('images/verificar.png') }}" alt="Olho aberto, símbolo de verificação de solicitação de agendamento.">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalAgendamento" tabindex="-1" aria-labelledby="modalAgendamentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                {{-- <form method="POST" action="{{ route('registrar.avaliacao') }}"> --}}
                    @csrf
                    {{-- <input type="hidden" name="id_agendamento" value="{{ $servico->id }}"> --}}

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgendamentoLabel">Nova Solicitação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            {{-- {{ TITULO DO SERVIÇO }} --}}
                        </div>

                        <div class="mb-3">
                           
                        </div>


                        <div class="mb-3">
                            <label for="comentario" class="form-label">Descrição</label>
                            <h3>
                                {{-- {{ DESCRICAO DA SOLICITAÇÃO }} --}}
                            </h3>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <img class="list_icons" src="{{ asset('images/confirmar.png') }}" alt="Botão para aceitar a solicitação de agendamento.">
                        <img class="list_icons" data-bs-dismiss="modal" src="{{ asset('images/negar.png') }}" alt="Botão para negar a solicitação de agendamento">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
