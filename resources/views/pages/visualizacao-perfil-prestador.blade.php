@extends('layouts.autenticado')

@section('title', 'Perfil do Prestador')

@include('components.modal-denunciar-usuario', ['motivos' => $motivos])

@section('content')
    <div class="container py-5 rounded-5">
        <div class="card shadow mx-auto" style="max-width: 900px;">
            <div class="card-header bg-info text-light text-center">
                <h3 class="mb-0">Perfil do Prestador</h3>
            </div>

            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center mb-3 mb-md-0">

                        @if ($usr->url_foto)
                            <img src="
                        {{ $usr->url_foto }}" alt="Foto do Prestador"
                                class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="
                        {{ asset('images/user-icon.png') }}" alt="Foto do Prestador"
                                class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="col-md-8">
                        <h4 class="fw-bold">
                            {{ $usr->nome }}
                        </h4>
                        <p class="mb-1"><strong>Especialidade:</strong>
                            {{ $usr->formacao->formacao ?? 'Não informada' }} <!-- VERIFICAR SE NÃO TÁ ERRADO. -->
                        </p>
                        <p><strong>Descrição:</strong>
                            {{ $usr->descricao ?? '—' }}
                        </p>
                    </div>
                </div>

                <hr>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <p><strong>Localização:</strong></p>
                        <p class="mb-0">
                            {{ $usr->logradouro }}, {{ $usr->numero }}
                            <br>
                            {{ $usr->bairro }} - {{ $usr->cidade }}/{{ $usr->uf }}
                            <br>
                            CEP:
                            {{ $usr->cep }}
                        </p>
                    </div>

                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <p><strong>Contatos:</strong></p>
                        <p class="mb-0"> Telefone:
                            {{ $usr->telefone }}
                        </p>
                        <p class="mb-0"> E-mail:
                            {{ $usr->email }}
                        </p>
                    </div>
                </div>

                <hr>

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <a href="#" class="btn btn-primary btn-geral">Enviar mensagem</a>
                    
                    <button data-bs-toggle="modal" data-bs-target="#modalDenunciarUsuarioTeste" class="btn btn-warning">Reportar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
