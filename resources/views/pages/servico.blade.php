@extends('layouts.autenticado')

@section('title', 'Agendar Serviço')
@section('styles')
    <style>
    .star-rating {
        direction: rtl;
        display: inline-flex;
        gap: 5px;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s ease-in-out;
    }

    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>
@endsection
@section('content')
    {{-- {{ dd($servico->caminho_foto) }} --}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success me-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="row shadow mt-3 mb-5 me-5" style="height: 100%; min-height: 700px;">

        <div class="d-flex justify-content-center align-items-center text-center" style="height: 150px">
            <h1 class=""> {{ $servico->nome_servico }} </h1>
        </div>


        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
            <div class="text-center">

                @if ($servico->url_foto)
                    <div>
                        <img class="service_photo" src="{{ asset("$servico->url_foto") }}" alt="Foto do serviço">
                    </div>
                @else
                    <div>
                        <img class="service_photo" src="{{ asset('images/servico-nulo.png') }}"
                            alt="Não há foto de serviço">
                    </div>
                @endif

                <div class="my-5">
                    <label for="data" class="form-label fw-bold">Selecione a Data:</label>
                    <input type="date" id="data" name="data" class="form-control text-cente" style="">
                </div>

                <button class="btn btn-info btn-geral text-white px-4 my-3">Agendar</button>
            </div>
        </div>

        <div class="col-12 col-md-4 text-center p-5 margin_div_servico">
            <h4 class="fw-bold mt-3">Descrição do serviço:</h4>
            <p class="text-justify">
                {{ $servico->desc_servico }}
            </p>
        </div>

        <div class="col-12 col-md-4 margin_div_servico d-flex justify-content-center align-items-center">
            <div>
                <a href="{{ route('show.perfil.prestador', $servico->usuario_id) }}">
                    <!-- LINK PARA O PERFIL DO PRESTADOR -->

                    <div class="d-flex justify-content-center">
                        <div class="">
                            @if ($servico->prestador->url_foto)
                                <img src="{{ $servico->prestador->url_foto }}" alt="Prestador" class="mb-2 rounded-circle"
                                    style="width: 360px; height: 360px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/user-icon.png') }}" alt="Prestador" class="mb-2 rounded-circle"
                                    style="width: 360px; height: 360px; object-fit: cover;">
                            @endif
                        </div>
                    </div>
                </a>

                <h3 class="fw-bold text-center my-4"> {{ $servico->prestador->nome }} </h3>
                <div class=" px-5 mx-5">
                    <p class="text-center">
                        {{ $servico->prestador->descricao }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center">Avaliações</h1>
    <!-- Botão que abre a modal -->
    <button class="mb-3 btn btn-info btn-geral text-white" data-bs-toggle="modal" data-bs-target="#modalAvaliacao">
        Enviar avaliação
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalAvaliacao" tabindex="-1" aria-labelledby="modalAvaliacaoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('registrar.avaliacao') }}">
                    @csrf
                    <input type="hidden" name="id_servico" value="{{ $servico->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAvaliacaoLabel">Nova Avaliação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nota" class="form-label">Titulo</label>
                            <input minlength="10" maxlength="25" class="form-control" type="text" name="titulo"
                                placeholder="Insira o título da sua avaliacao" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Quantas estrelas?</label>
                            <div class="star-rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="nota"
                                        value="{{ $i }}" required>
                                    <label for="star{{ $i }}" title="{{ $i }} estrelas">★</label>
                                @endfor
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentário</label>
                            <textarea minlength="30" maxlength="100" name="comentario" id="comentario" class="form-control"
                                placeholder="Comentário com, no mínimo, 30 letras e com no máximo 100 letras." rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enviar Avaliação</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-2 ml-1 mr-1 mb-1">
        <div class="d-flex flex-wrap justify-content-center div-avaliacoes">
            @if ($avaliacoes->isNotEmpty())
                @foreach ($avaliacoes as $avaliacao)
                    <x-card-avaliacao
                        :profileImage="$avaliacao->cliente->url_foto"
                        title="{{ $avaliacao->titulo }}" userName="{{ $avaliacao->cliente->nome ?? 'Anônimo' }}"
                        rating="{{ $avaliacao->nota }}" description="{{ $avaliacao->comentario }}" />
                @endforeach
            @else
                <h1>Não há avaliações para esse serviço.</h1>
            @endif
        </div>
    </div>
@endsection
