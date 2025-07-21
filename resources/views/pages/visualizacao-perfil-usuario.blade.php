@extends('layouts.autenticado')

@section('title', 'Perfil do Usuário')

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

    <div class="profile-container">
        <!-- Seção do Header do Perfil -->
        <div class="profile-header">
            <div class="profile-avatar">
                @if($usr->url_foto)
                    <img src="{{ $usr->url_foto }}" alt="Foto de perfil" class="avatar-img">
                @else
                    <img src="{{ asset('images/user-icon.png') }}" alt="Foto padrão" class="avatar-img">
                @endif
                <div class="avatar-overlay" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                    <i class="fa-solid fa-camera"></i>
                </div>
            </div>
            <div class="profile-info">
                <h1 class="profile-name">{{ auth()->user()->nome }}</h1>
                <p class="profile-email">{{ auth()->user()->email }}</p>
                @if(auth()->user()->descricao)
                    <p class="profile-description">{{ auth()->user()->descricao }}</p>
                @endif
                <div class="profile-badges">
                    @if(auth()->user()->formacao)
                        <span class="badge badge-info">{{ auth()->user()->formacao->nome }}</span>
                    @endif
                </div>
            </div>
            <div class="profile-actions">
                <x-btn variant="padrao" type="button" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    Editar Perfil
                </x-btn>
            </div>
        </div>

        <!-- Cards de Informações -->
        <div class="row g-4 mb-4">
            <!-- Informações Pessoais -->
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="fa-solid fa-user info-icon"></i>
                        <h3>Informações Pessoais</h3>
                    </div>
                    <div class="info-card-body">
                        <div class="info-item">
                            <label>Telefone</label>
                            <span>{{ auth()->user()->telefone }}</span>
                        </div>
                        <div class="info-item">
                            <label>CPF/CNPJ</label>
                            <span>{{ auth()->user()->cpf_cnpj }}</span>
                        </div>
                        <div class="info-item">
                            <label>Data de Nascimento</label>
                            <span>{{ \Carbon\Carbon::parse(auth()->user()->data_nascimento)->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <label>Descrição</label>
                            <span>{{ auth()->user()->descricao ?? 'Não há descrição' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Endereço -->
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="fa-solid fa-location-dot info-icon"></i>
                        <h3>Endereço</h3>
                    </div>
                    <div class="info-card-body">
                        <div class="info-item">
                            <label>Logradouro</label>
                            <span>{{ auth()->user()->logradouro }}, {{ auth()->user()->numero }}</span>
                        </div>
                        @if(auth()->user()->complemento)
                            <div class="info-item">
                                <label>Complemento</label>
                                <span>{{ auth()->user()->complemento }}</span>
                            </div>
                        @endif
                        <div class="info-item">
                            <label>Bairro</label>
                            <span>{{ auth()->user()->bairro }}</span>
                        </div>
                        <div class="info-item">
                            <label>Cidade/UF</label>
                            <span>{{ auth()->user()->cidade }}/{{ auth()->user()->uf }}</span>
                        </div>
                        <div class="info-item">
                            <label>CEP</label>
                            <span>{{ auth()->user()->cep }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Redes Sociais -->
        <div class="col-12">
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fa-solid fa-share-nodes info-icon"></i>
                    <h3>Redes Sociais</h3>
                </div>
                <div class="info-card-body">
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
                        <div class="social-links">
                            @foreach($rs as $rede)
                                <a href="{{ $rede }}" target="_blank" class="social-link">
                                    <i class="fa-solid fa-external-link-alt me-2"></i>
                                    {{ $rede }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Nenhuma rede social informada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('components.modal-editar-perfil', ['usr' => $usr, 'lista' => $lista, 'imagem_url' => $imagem_url])

@endsection