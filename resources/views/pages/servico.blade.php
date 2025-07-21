@extends('layouts.autenticado')
@section('title', 'Agendar Serviço')

@section('content')
    {{-- Alerts --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-modern">
            <div class="alert-icon">
                <i class="fa-solid fa-exclamation-triangle"></i>
            </div>
            <div class="alert-content">
                <strong>Ops! Algo deu errado:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-modern">
            <div class="alert-icon">
                <i class="fa-solid fa-exclamation-triangle"></i>
            </div>
            <div class="alert-content">
                <strong>Erro:</strong> {{ session('error') }}
            </div>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-modern">
            <div class="alert-icon">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="alert-content">
                <strong>Sucesso:</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Header da página -->
    <div class="service-page-header">
        <div class="container">
            <div class="header-content">
                <div class="breadcrumb-modern">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                        <i class="fa-solid fa-home"></i>
                        Início
                    </a>
                    <i class="fa-solid fa-chevron-right breadcrumb-separator"></i>
                    <span class="breadcrumb-current">Detalhes do Serviço</span>
                </div>
                <h1 class="service-main-title">{{ $servico->nome_servico }}</h1>
                <p class="service-subtitle">Conheça todos os detalhes e agende seu serviço</p>
            </div>
        </div>
    </div>

    <div class="container service-content">
        <div class="row g-4 align-items-stretch justify-content-center">
            {{-- Card do Serviço --}}
            <div class="col-12 col-lg-6">
                <div class="service-detail-card">
                    <div class="card-image-container">
                        @if ($servico->url_foto)
                            <img src="{{ asset($servico->url_foto) }}" alt="Foto do serviço"
                                class="service-image">
                        @else
                            <img src="{{ asset('images/servico-nulo.png') }}" alt="Não há foto de serviço"
                                class="service-image">
                        @endif
                        <div class="price-badge">
                            <span class="price-label">Preço</span>
                            <span class="price-value">R$ {{ number_format($servico->preco, 2, ',', '.') }}</span>
                        </div>
                        <div class="category-badge">
                            <i class="fa-solid fa-tag"></i>
                            {{ $servico->categoriaObj->nome ?? 'Sem categoria' }}
                        </div>
                    </div>
                    
                    <div class="service-detail-body">
                        <div class="service-info">
                            <h2 class="service-title">{{ $servico->nome_servico }}</h2>
                            
                            <div class="description-section">
                                <h3 class="section-label">
                                    <i class="fa-solid fa-align-left"></i>
                                    Descrição do serviço
                                </h3>
                                <p class="service-description">{{ $servico->desc_servico }}</p>
                            </div>
                        </div>
                        
                        @if(auth()->id() !== $servico->usuario_id)
                            <div class="action-section">
                                <button class="btn-schedule" data-bs-toggle="modal" data-bs-target="#modalAgendamento">
                                    <i class="fa-solid fa-calendar-plus"></i>
                                    <span>Agendar Serviço</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Card do Prestador --}}
            <div class="col-12 col-lg-6">
                <div class="provider-card">
                    <div class="provider-header">
                        <h3 class="provider-section-title">
                            <i class="fa-solid fa-user-tie"></i>
                            Prestador do Serviço
                        </h3>
                    </div>
                    
                    <a href="{{ route('show.perfil.prestador', $servico->usuario_id) }}" class="provider-link">
                        <div class="provider-content">
                            <div class="provider-avatar">
                                @if ($servico->prestador->url_foto)
                                    <img src="{{ $servico->prestador->url_foto }}" alt="Prestador" class="avatar-image">
                                @else
                                    <img src="{{ asset('images/user-icon.png') }}" alt="Prestador" class="avatar-image">
                                @endif
                                <div class="avatar-badge">
                                    <i class="fa-solid fa-shield-check"></i>
                                </div>
                            </div>
                            
                            <div class="provider-info">
                                <h4 class="provider-name">{{ $servico->prestador->nome }}</h4>
                                <span class="provider-username">{{ '@'.$servico->prestador->username ?? '' }}</span>
                                @if($servico->prestador->descricao)
                                    <p class="provider-description">{{ $servico->prestador->descricao }}</p>
                                @endif
                                
                                <div class="provider-contact">
                                    <div class="contact-item">
                                        <i class="fa-solid fa-envelope"></i>
                                        <span>{{ $servico->prestador->email }}</span>
                                    </div>
                                    @if($servico->prestador->telefone)
                                        <div class="contact-item">
                                            <i class="fa-solid fa-phone"></i>
                                            <span>{{ $servico->prestador->telefone }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Ações adicionais --}}
        @if(auth()->id() !== $servico->usuario_id)
            <div class="additional-actions">
                <div class="actions-container">
                    <button class="action-btn action-btn-primary" data-bs-toggle="modal" data-bs-target="#modalAvaliacao">
                        <i class="fa-solid fa-star"></i>
                        <span>Enviar Avaliação</span>
                    </button>
                    <button class="action-btn action-btn-danger" data-bs-toggle="modal" data-bs-target="#modalDenunciarUsuarioTeste">
                        <i class="fa-solid fa-flag"></i>
                        <span>Denunciar Serviço</span>
                    </button>
                </div>
            </div>
            @include('components.modal-denunciar-servico', ['motivos' => $motivos])
        @endif

        {{-- Seção de Avaliações --}}
        <div class="reviews-section">
            <div class="reviews-header">
                <h2 class="reviews-title">
                    <i class="fa-solid fa-comments"></i>
                    Avaliações dos Clientes
                </h2>
                <p class="reviews-subtitle">Veja o que outros clientes estão dizendo sobre este serviço</p>
            </div>
            
            <div class="reviews-container">
                @if ($avaliacoes->isNotEmpty())
                    <div class="reviews-grid">
                        @foreach ($avaliacoes as $avaliacao)
                            <div class="review-card-modern">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <img src="{{ $avaliacao->cliente->url_foto ?? asset('images/user-icon.png') }}" 
                                             alt="{{ $avaliacao->cliente->nome ?? 'Anônimo' }}" 
                                             class="reviewer-avatar">
                                        <div class="reviewer-details">
                                            <h5 class="reviewer-name">{{ $avaliacao->cliente->nome ?? 'Anônimo' }}</h5>
                                            <div class="review-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= (int) $avaliacao->nota ? 'star-filled' : 'star-empty' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-content">
                                    <h6 class="review-title">{{ $avaliacao->titulo }}</h6>
                                    <p class="review-text">{{ $avaliacao->comentario }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-reviews">
                        <div class="no-reviews-icon">
                            <i class="fa-solid fa-comment-slash"></i>
                        </div>
                        <h4>Ainda não há avaliações</h4>
                        <p>Seja o primeiro a avaliar este serviço e ajude outros clientes!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- MODAL AGENDAMENTO --}}
    <div class="modal fade" id="modalAgendamento" tabindex="-1" aria-labelledby="modalAgendamentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-modern">
                <form method="POST" action="{{ route('agendar') }}">
                    @csrf
                    <input type="hidden" name="id_servico" value="{{ $servico->id }}">
                    <div class="modal-header modal-header-modern">
                        <h5 class="modal-title" id="modalAgendamentoLabel">
                            <i class="fa-solid fa-calendar-plus me-2"></i>
                            Novo Agendamento
                        </h5>
                        <button type="button" class="btn-close-modern" data-bs-dismiss="modal" aria-label="Fechar">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body modal-body-modern">
                        <div class="form-group-modal">
                            <label for="data" class="form-label-modal">
                                <i class="fa-solid fa-calendar-day me-2"></i>
                                Selecione a data
                            </label>
                            <input type="text" class="form-control-modal" name="data" id="data" 
                                   placeholder="dd/mm/aaaa" maxlength="10" required>
                        </div>
                        <div class="form-group-modal">
                            <label for="descricao" class="form-label-modal">
                                <i class="fa-solid fa-pen me-2"></i>
                                Descrição do serviço necessário
                            </label>
                            <textarea class="form-control-modal" name="descricao" id="descricao" rows="4"
                                      placeholder="Descreva detalhes específicos do serviço que você precisa..."
                                      minlength="20" maxlength="200" required></textarea>
                            <small class="form-help-text">Mínimo 20 caracteres, máximo 200</small>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-modern">
                        <button type="button" class="btn-modal-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-times me-2"></i>
                            Cancelar
                        </button>
                        <button type="submit" class="btn-modal-primary">
                            <i class="fa-solid fa-paper-plane me-2"></i>
                            Enviar Solicitação
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL AVALIAÇÃO --}}
    <div class="modal fade" id="modalAvaliacao" tabindex="-1" aria-labelledby="modalAvaliacaoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-modern">
                <form method="POST" action="{{ route('registrar.avaliacao') }}">
                    @csrf
                    <input type="hidden" name="id_servico" value="{{ $servico->id }}">
                    <div class="modal-header modal-header-modern">
                        <h5 class="modal-title" id="modalAvaliacaoLabel">
                            <i class="fa-solid fa-star me-2"></i>
                            Nova Avaliação
                        </h5>
                        <button type="button" class="btn-close-modern" data-bs-dismiss="modal" aria-label="Fechar">
                            <i class="fa-solid fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body modal-body-modern">
                        <div class="form-group-modal">
                            <label for="titulo" class="form-label-modal">
                                <i class="fa-solid fa-heading me-2"></i>
                                Título da avaliação
                            </label>
                            <input type="text" class="form-control-modal" name="titulo" id="titulo"
                                   placeholder="Resuma sua experiência em poucas palavras"
                                   minlength="10" maxlength="25" required>
                        </div>
                        <div class="form-group-modal">
                            <label class="form-label-modal">
                                <i class="fa-solid fa-star me-2"></i>
                                Quantas estrelas você daria?
                            </label>
                            <div class="star-rating-modern">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="nota" value="{{ $i }}" required>
                                    <label for="star{{ $i }}" title="{{ $i }} estrelas">
                                        <i class="fa-solid fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                        </div>
                        <div class="form-group-modal">
                            <label for="comentario" class="form-label-modal">
                                <i class="fa-solid fa-comment me-2"></i>
                                Comentário detalhado
                            </label>
                            <textarea class="form-control-modal" name="comentario" id="comentario" rows="4"
                                      placeholder="Conte sua experiência com este serviço..."
                                      minlength="30" maxlength="100" required></textarea>
                            <small class="form-help-text">Mínimo 30 caracteres, máximo 100</small>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-modern">
                        <button type="button" class="btn-modal-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-times me-2"></i>
                            Cancelar
                        </button>
                        <button type="submit" class="btn-modal-primary">
                            <i class="fa-solid fa-star me-2"></i>
                            Enviar Avaliação
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Máscara para data
        document.getElementById('data').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) value = value.replace(/(\d{2})(\d)/, '$1/$2');
            if (value.length > 5) value = value.replace(/(\d{2})\/(\d{2})(\d)/, '$1/$2/$3');
            e.target.value = value;
        });
    </script>
@endsection
