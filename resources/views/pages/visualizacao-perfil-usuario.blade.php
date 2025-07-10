@extends('layouts.autenticado')

@section('title', 'Perfil do Usuário')

@section('content')
<div class="container py-5">
    <div class="card shadow mx-auto" style="max-width: 800px;">
        <div class="card-header bg-info text-center">
            <h3 class="mb-0 text-light">Perfil do Usuário</h3>
        </div>

        <div class="card-body">
            <div class="text-center mb-4">
                @if(auth()->user()->caminho_img)
                    <img src="
                    {{ asset('storage/' . auth()->user()->caminho_img) }}
                     " alt="Foto de perfil"
                        class="rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/user-icon.png') }}" alt="Foto padrão"
                        class="rounded-circle shadow">
                @endif
            </div>

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
            
            <div class="text-end">
                <a href="{{ route('mostrar.edicao', ['id' => auth()->id()]) }}" class="btn btn-primary">
                    Editar Perfil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
