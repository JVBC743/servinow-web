@extends('layouts.autenticado')
@section('title', 'Agendar Serviço')

@section('content')
    {{-- Alerts --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger rounded-4 shadow-sm">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success rounded-4 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="container py-4">
        <div class="row g-4 align-items-stretch justify-content-center">
            {{-- Card do Serviço --}}
            <div class="col-12 col-lg-5">
                <div class="card h-100 shadow-lg border-0 rounded-5 position-relative">
                    @if ($servico->url_foto)
                        <img src="{{ asset($servico->url_foto) }}" alt="Foto do serviço"
                            class="card-img-top rounded-top-5" style="object-fit:cover; height:320px;">
                    @else
                        <img src="{{ asset('images/servico-nulo.png') }}" alt="Não há foto de serviço"
                            class="card-img-top rounded-top-5" style="object-fit:cover; height:320px;">
                    @endif
                    <span class="badge bg-success position-absolute top-0 end-0 m-3 fs-5 shadow" style="z-index:2;">
                        R$ {{ number_format($servico->preco, 2, ',', '.') }}
                    </span>
                    <div class="card-body d-flex flex-column">
                        <h1 class="card-title fw-bold text-primary mb-2">{{ $servico->nome_servico }}</h1>
                        <h6 class="text-muted mb-3">{{ $servico->categoriaObj->nome ?? 'Categoria não informada' }}</h6>
                        <h5 class="fw-bold mt-3">Descrição do serviço:</h5>
                        <p class="card-text flex-grow-1">{{ $servico->desc_servico }}</p>
                        @if(auth()->id() !== $servico->usuario_id)
                            <button class="btn btn-info btn-geral text-white px-4 my-3 w-100" data-bs-toggle="modal" data-bs-target="#modalAgendamento">
                                <i class="bi bi-calendar2-plus me-2"></i> Agendar
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Card do Prestador --}}
            <div class="col-12 col-lg-5">
                <div class="card h-100 shadow-lg border-0 rounded-5 text-center p-4 d-flex flex-column align-items-center">
                    <a href="{{ route('show.perfil.prestador', $servico->usuario_id) }}" class="text-decoration-none text-dark">
                        <div class="mb-3">
                            @if ($servico->prestador->url_foto)
                                <img src="{{ $servico->prestador->url_foto }}" alt="Prestador"
                                    class="rounded-circle shadow" style="width: 160px; height: 160px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/user-icon.png') }}" alt="Prestador"
                                    class="rounded-circle shadow" style="width: 160px; height: 160px; object-fit: cover;">
                            @endif
                        </div>
                        <h3 class="fw-bold mb-1">{{ $servico->prestador->nome }}</h3>
                        <span class="badge bg-primary mb-2 px-3 py-2 fs-6">{{ '@'.$servico->prestador->username ?? '' }}</span>
                        <p class="mb-0">{{ $servico->prestador->descricao }}</p>
                    </a>
                </div>
            </div>
        </div>

        {{-- Botões de avaliação e denúncia --}}
        <div class="row mt-4 justify-content-center">
            <div class="col-12 col-lg-10 d-flex flex-wrap gap-3 justify-content-center">
                @if(auth()->id() !== $servico->usuario_id)
                    <button class="btn btn-info btn-geral text-white" data-bs-toggle="modal" data-bs-target="#modalAvaliacao">
                        <i class="bi bi-star-half me-2"></i> Enviar avaliação
                    </button>
                    <x-btn variant="vermelho" type="button" data-bs-toggle="modal" data-bs-target="#modalDenunciarUsuarioTeste">
                        <i class="bi bi-flag-fill me-2"></i> Denunciar Serviço
                    </x-btn>
                    @include('components.modal-denunciar-servico', ['motivos' => $motivos])

                @endif
            </div>
        </div>

        {{-- Avaliações --}}
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="text-center mb-4">Avaliações</h2>
                <div class="rounded-5 d-flex flex-wrap justify-content-center gap-4 div-avaliacoes">
                    @if ($avaliacoes->isNotEmpty())
                        @foreach ($avaliacoes as $avaliacao)
                            <x-card-avaliacao
                                :profileImage="$avaliacao->cliente->url_foto"
                                title="{{ $avaliacao->titulo }}"
                                userName="{{ $avaliacao->cliente->nome ?? 'Anônimo' }}"
                                :rating="(int) $avaliacao->nota"
                                description="{{ $avaliacao->comentario }}" />
                        @endforeach
                    @else
                        <h4 class="text-center w-100">Não há avaliações para esse serviço.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL AGENDAMENTO --}}
    <div class="modal fade" id="modalAgendamento" tabindex="-1" aria-labelledby="modalAgendamentoabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('agendar') }}">
                    @csrf
                    <input type="hidden" name="id_servico" value="{{ $servico->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAvaliacaoLabel">Novo Agendamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="data" class="form-label">Selecione a data</label>
                            <input maxlength="10" type="text" class="form-control" name="data" id="data" placeholder="dd/mm/aaaa">
                            <script>
                                const dataInput = document.getElementById('data');
                                dataInput.addEventListener('input', function (e) {
                                    let value = e.target.value.replace(/\D/g, '');
                                    if (value.length > 2) value = value.replace(/(\d{2})(\d)/, '$1/$2');
                                    if (value.length > 5) value = value.replace(/(\d{2})\/(\d{2})(\d)/, '$1/$2/$3');
                                    e.target.value = value;
                                });
                            </script>
                        </div>
                        <div class="mb-3">
                            <label for="descricao">Insira uma descrição</label>
                            <textarea maxlength="50" minlength="20" class="form-control" name="descricao" placeholder="Insira aqui a sua descrição"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enviar solicitação</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL AVALIAÇÃO --}}
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
                            <label for="titulo" class="form-label">Título</label>
                            <input minlength="10" maxlength="25" class="form-control" type="text" name="titulo"
                                placeholder="Insira o título da sua avaliação" required>
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
                        <button type="submit" class="btn btn-success">Avaliar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 2rem !important;
        }
        .card-img-top {
            border-top-left-radius: 2rem !important;
            border-top-right-radius: 2rem !important;
        }
        .badge.bg-success {
            font-size: 1.2rem;
            padding: 0.7em 1.3em;
            border-radius: 2em;
            box-shadow: 0 2px 8px #0002;
            letter-spacing: 0.5px;
        }
        .star-rating {
            direction: rtl;
            display: flex;
            justify-content: center;
            gap: 0.2em;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffc107;
        }
        @media (max-width: 991px) {
            .card-img-top {
                height: 220px !important;
            }
        }
        @media (max-width: 767px) {
            .card-img-top {
                height: 160px !important;
            }
            .card {
                border-radius: 1.2rem !important;
            }
        }
    </style>
@endpush
