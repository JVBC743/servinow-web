@extends('layouts.autenticado')

@section('title', 'Perfil do Usuário')

@section('content')

    <div class="card-body">
        <div class="text-center mb-4">
            @if($usr->url_foto)
                <img src="
                                                                    {{ $usr->url_foto }}
                                                                     " alt="Foto de perfil" class="rounded-circle shadow"
                    style="width: 120px; height: 120px; object-fit: cover;">
            @else
                <img src="{{ asset('images/user-icon.png') }}" alt="Foto padrão" class="rounded-circle shadow">
            @endif
        </div>


        <div class="table-responsive table-scroll-vertical">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Nome</th>
                        <td>
                            {{ auth()->user()->nome }}
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            {{ auth()->user()->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>Telefone</th>
                        <td>
                            {{ auth()->user()->telefone }}
                        </td>
                    </tr>
                    <tr>
                        <th>CPF/CNPJ</th>
                        <td>
                            {{ auth()->user()->cpf_cnpj }}
                        </td>
                    </tr>
                    <tr>
                        <th>Data de Nascimento</th>
                        <td>
                            {{ \Carbon\Carbon::parse(auth()->user()->data_nascimento)->format('d/m/Y') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Descrição</th>
                        <td>{{ auth()->user()->descricao ?? 'Não há descrição' }}</td>
                    </tr>
                    <tr>
                        <th>Formação</th>
                        <td>
                            {{ auth()->user()->formacao->nome ?? 'Não possui formação' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Endereço</th>
                        <td>
                            {{ auth()->user()->logradouro }}, {{ auth()->user()->numero }}
                            {{ auth()->user()->complemento ? '- ' . auth()->user()->complemento : '' }},
                            {{ auth()->user()->bairro }} - {{ auth()->user()->cidade }}/{{ auth()->user()->uf }},
                            CEP:
                            {{ auth()->user()->cep }}
                        </td>
                    </tr>
                    <tr>
                        <th>Redes Sociais</th>
                        <td>
                            @php
                                $rs = [
                                    auth()->user()->rede_social1,
                                    auth()->user()->rede_social2,
                                    auth()->user()->rede_social3,
                                    auth()->user()->rede_social4
                                ];
                                $rs = array_filter($rs);
                            @endphp
                            @if(count($rs) > 0)
                                <ul class="list-unstyled mb-0">
                                    @foreach($rs as $rede)
                                        <li><a href="{{ $rede }}" target="_blank">{{ $rede }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                Nenhuma rede social informada.
                            @endif

                        </td>
                    </tr>
                </tbody>
            </table>
            <small class="d-md-none text-muted">Deslize para o lado para ver mais →</small>
        </div>

        <div class="text-end">
            <a href="{{ route('mostrar.edicao', ['id' => auth()->id()]) }}" class="btn btn-primary btn-geral">
                Editar Perfil
            </a>
        </div>
        <div class="text-end mt-3">
            <button type="button" class="btn btn-verde" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                Testar Modal Editar Perfil
            </button>
        </div>
        @include('components.modal-editar-perfil', ['usr' => $usr, 'lista' => $lista, 'imagem_url' => $imagem_url])

    </div>
    </div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection