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
                <h1 class="profile-name">{{ $usr->nome }}</h1>
                <p class="profile-email">{{ $usr->email }}</p>
                @if($usr->descricao)
                    <p class="profile-description">{{ $usr->descricao }}</p>
                @endif
                <div class="profile-badges">
                    @if($usr->formacao)
                        <span class="badge badge-info">{{ $usr->formacao->formacao }}</span>
                    @endif
                </div>
            </div>
            <div class="profile-actions">
                <x-btn variant="padrao-detalhado" type="button" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">
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
                            <span>{{ $usr->telefone }}</span>
                        </div>
                        <div class="info-item">
                            <label>CPF/CNPJ</label>
                            <span>{{ $usr->cpf_cnpj }}</span>
                        </div>
                        <div class="info-item">
                            <label>Data de Nascimento</label>
                            <span>{{ \Carbon\Carbon::parse($usr->data_nascimento)->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <label>Área de Atuação</label>
                            <span>{{ $usr->formacao ? $usr->formacao->formacao : 'Não informado' }}</span>
                        </div>
                        <div class="info-item">
                            <label>Descrição</label>
                            <span>{{ $usr->descricao ?? 'Não há descrição' }}</span>
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
                            <span>{{ $usr->logradouro }}, {{ $usr->numero }}</span>
                        </div>
                        @if($usr->complemento)
                            <div class="info-item">
                                <label>Complemento</label>
                                <span>{{ $usr->complemento }}</span>
                            </div>
                        @endif
                        <div class="info-item">
                            <label>Bairro</label>
                            <span>{{ $usr->bairro }}</span>
                        </div>
                        <div class="info-item">
                            <label>Cidade/UF</label>
                            <span>{{ $usr->cidade }}/{{ $usr->uf }}</span>
                        </div>
                        <div class="info-item">
                            <label>CEP</label>
                            <span>{{ $usr->cep }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('components.modal-editar-perfil', ['usr' => $usr, 'lista' => $lista, 'imagem_url' => $imagem_url])
@endsection