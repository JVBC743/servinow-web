@extends('layouts.autenticado')

@section('title', 'Lista de Usuários')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
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
                                        <form action="{{ route('admin.excluir.conta', $usr->id) }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete_icon_button bg-transparent border-0 p-0">
                                                <i class="fa-solid fa-trash del-icon"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
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