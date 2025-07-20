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

    <div class="rounded-5 container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 1200px">

            <h1 class="text-center mb-4">Solicitações de agendamento pelos seus serviços</h1>
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Solicitante</th>
                        <th>Serviço</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agendamento as $item)
                        @if($item->id_prestador == auth()->id() && $item->status == 1)

                            <tr class="text-align-center">
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->id_cliente ? $item->cliente->nome : 'Cliente inexistente.'}} </td>
                                <td> {{ $item->id_servico ? $item->servico->nome_servico : 'Serviço inexistente.'}} </td>
                                <td> {{ $item->prazo_formatado}} </td>
                                <td class="d-flex justify-content-between">
                                    {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                    <div>
                                        <i class="fa-solid fa-eye eye-icon" data-bs-toggle="modal"
                                            data-bs-target="#modalSolicitacao{{ $item->id }}"></i>
                                        <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                            <i class="fa-solid fa-circle-info info-icon"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <x-modal-default
                                :id="'modalSolicitacao' . $item->id"
                                :title="'Nova Solicitação'"
                            >
                                <div>
                                    <div class="form-group-editar-perfil mb-3">
                                        <label class="label-editar-perfil">Solicitante</label>
                                        <input type="text" class="form-control input-editar-perfil" value="{{ $item->id_cliente ? $item->cliente->nome : 'Cliente inexistente.' }}" disabled>
                                    </div>
                                    <div class="form-group-editar-perfil mb-3">
                                        <label class="label-editar-perfil">Telefone para contato</label>
                                        <input type="text" class="form-control input-editar-perfil" value="{{ $item->id_cliente ? $item->cliente->telefone : 'Telefone inexistente' }}" disabled>
                                    </div>
                                    <div class="form-group-editar-perfil mb-0">
                                        <label class="label-editar-perfil">Descrição</label>
                                        <textarea class="form-control input-editar-perfil" rows="4" disabled>{{ $item->descricao }}</textarea>
                                    </div>
                                </div>
                                <x-slot name="footer_left">
                                    <form action="{{ route('negacao.solicitacao') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                        <x-btn variant="vermelho" type="submit" name="negar">
                                            Negar solicitação
                                        </x-btn>
                                    </form>
                                </x-slot>
                                <x-slot name="footer_right">
                                    <form action="{{ route('aceitacao.solicitacao') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                        <x-btn variant="verde" type="submit" name="aceitar">
                                            Aceitar solicitação
                                        </x-btn>
                                    </form>
                                </x-slot>
                            </x-modal-default>
                            ?>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection