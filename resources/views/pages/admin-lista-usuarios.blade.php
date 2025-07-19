@extends('layouts.autenticado')

@section('title', 'Lista de Usuários')

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

            <h1 class="text-center mb-4">Lista de Usuários</h1>
            <div class="table-responsive table-scroll-vertical">

                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>CPF/CNPJ</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lista as $usr)
                            @if($usr->id != auth()->id())
                                <tr>
                                    <td>{{ $usr->id }}</td>
                                    <td>{{ $usr->nome }}</td>
                                    <td>{{ $usr->telefone }}</td>
                                    <td>{{ $usr->email }}</td>
                                    <td>{{ $usr->cpf_cnpj }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-3">
                                            <a href="{{ route('admin.mostrar.edicao', $usr->id) }}">
                                                <i class="fa-solid fa-pen-to-square edit-icon"></i>
                                            </a>
                                            <form action="{{ route('admin.excluir.usuario', $usr->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete_icon_button bg-transparent border-0 p-0" data-bs-toggle="modal" data-bs-target="#modalExcluirConta{{ $usr->id }}">
                                                    <i class="fa-solid fa-trash del-icon"></i>
                                                </button>
                                            </form>
                                            <div class="modal fade" id="modalExcluirConta{{ $usr->id }}" tabindex="-1" aria-labelledby="modalExcluirContaLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.excluir.usuario', $usr->id ) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="titleModalExcluirConta">Tem certeza?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <p>Caso você prossiga com essa ação, a sua conta, serviços, agendamentos, solicitações e avaliações serão excluídas do sistema.
                                                                    E nenhum desses dados podem ser recuperados.
                                                                </p>
                                                            </div>

                                                            <div class="modal-footer">

                                                                <button type="submit" class="btn btn-danger" >Confirmar Exclusão</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Nenhum usuário encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <small class="d-md-none text-muted">Deslize para o lado para ver mais →</small>
            </div>
        </div>
    </div>
@endsection