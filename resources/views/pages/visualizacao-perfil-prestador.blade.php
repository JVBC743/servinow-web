@extends('layouts.autenticado')

@section('title', 'Perfil do Prestador')

@section('content')
<div class="container py-5">
    <div class="card shadow mx-auto" style="max-width: 900px;">
        <div class="card-header bg-info text-light text-center">
            <h3 class="mb-0">Perfil do Prestador</h3>
        </div>

        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <img src="
                    {{-- {{ $usuario->caminho_img ?? 'https://via.placeholder.com/150' }} --}}
                     "
                         alt="Foto do Prestador"
                         class="rounded-circle shadow"
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>

                <div class="col-md-8">
                    <h4 class="fw-bold">
                        {{-- {{ $usuario->nome }} --}}
                    </h4>
                    <p class="mb-1"><strong>Especialidade:</strong> 
                        {{-- {{ $usuario->formacao->nome ?? 'Não informada' }} --}}
                    </p>
                    <p><strong>Descrição:</strong> 
                        {{-- {{ $usuario->descricao ?? '—' }} --}}
                    </p>
                </div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Localização:</strong></p>
                    <p class="mb-0">
                        {{-- {{ $usuario->logradouro }}, {{ $usuario->numero }} --}}
                        <br>
                        {{-- {{ $usuario->bairro }} - {{ $usuario->cidade }}/{{ $usuario->uf }} --}}
                        <br>
                        CEP: 
                        {{-- {{ $usuario->cep }} --}}
                    </p>
                </div>

                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <p><strong>Contatos:</strong></p>
                    <p class="mb-0">📞 
                        {{-- {{ $usuario->telefone }} --}}
                    </p>
                    <p class="mb-0">✉️ 
                        {{-- {{ $usuario->email }} --}}

                    </p>
                </div>
            </div>

            <hr>

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <a href="#" class="btn btn-primary">Enviar mensagem</a>
                <a href="#" class="btn btn-success">Agendar</a>
                <button class="btn btn-warning">⚠️ Reportar</button>
            </div>
        </div>
    </div>
</div>

@endsection
