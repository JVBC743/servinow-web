@extends('layouts.autenticado')
@section('title', 'Cadastrar Serviço')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <!-- Header da página -->
                <div class="page-header mb-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div>
                            <h1 class="page-title mb-2">
                                <i class="fa-solid fa-plus-circle me-3"></i>
                                Cadastrar Novo Serviço
                            </h1>
                            <p class="page-subtitle text-muted mb-0">
                                Preencha as informações abaixo para cadastrar seu serviço
                            </p>
                        </div>
                        <div class="page-actions">
                            <x-btn variant="branco" type="button" onclick="window.location='{{ route('dashboard') }}'">
                                <i class="fa-solid fa-arrow-left me-2"></i>
                                Voltar
                            </x-btn>
                        </div>
                    </div>
                </div>

                <!-- Card principal -->
                <div class="service-card">
                    <form action="{{ route('servico.store') }}" method="POST" enctype="multipart/form-data" id="form-servico">
                        @csrf

                        <!-- Seção de Upload de Imagem -->
                        <div class="upload-section">
                            <div class="upload-header">
                                <h3 class="section-title">
                                    <i class="fa-solid fa-image me-2"></i>
                                    Imagem do Serviço
                                </h3>
                                <span class="required-badge">Obrigatório</span>
                            </div>
                            
                            <div class="upload-area" id="upload-area">
                                <div class="upload-placeholder" id="upload-placeholder">
                                    <div class="upload-icon">
                                        <i class="fa-solid fa-cloud-upload-alt"></i>
                                    </div>
                                    <h4>Clique ou arraste uma imagem</h4>
                                    <p>PNG, JPG ou JPEG até 5MB</p>
                                    <button type="button" class="btn btn-upload-custom">
                                        <i class="fa-solid fa-folder-open me-2"></i>
                                        Escolher Arquivo
                                    </button>
                                </div>
                                
                                <div class="upload-preview d-none" id="upload-preview">
                                    <img id="img-preview" class="preview-image" alt="Prévia da imagem">
                                    <div class="preview-overlay">
                                        <button type="button" class="btn btn-change-custom">
                                            <i class="fa-solid fa-edit me-2"></i>
                                            Alterar
                                        </button>
                                    </div>
                                </div>
                                
                                <input type="file" name="imagem" id="imagem" class="upload-input" accept="image/*" required>
                            </div>
                            
                            @error('imagem')
                                <div class="error-message">
                                    <i class="fa-solid fa-exclamation-circle me-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Seção de Informações Básicas -->
                        <div class="info-section">
                            <div class="section-header">
                                <h3 class="section-title">
                                    <i class="fa-solid fa-info-circle me-2"></i>
                                    Informações Básicas
                                </h3>
                            </div>

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-group-modern">
                                        <label for="nome" class="form-label-modern">
                                            Título do Serviço
                                            <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            name="nome" 
                                            id="nome" 
                                            class="form-control-modern"
                                            placeholder="Ex: Manutenção de computadores domésticos" 
                                            value="{{ old('nome') }}" 
                                            minlength="20"
                                            maxlength="40" 
                                            required>
                                        <div class="form-help">
                                            <span class="char-counter">
                                                <span id="nome-count">0</span>/40 caracteres
                                            </span>
                                        </div>
                                        @error('nome')
                                            <div class="error-message">
                                                <i class="fa-solid fa-exclamation-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label for="categoria" class="form-label-modern">
                                            Categoria
                                            <span class="required">*</span>
                                        </label>
                                        <div class="select-wrapper">
                                            <select name="categoria" id="categoria" class="form-select-modern" required>
                                                <option value="">Selecione uma categoria</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                                                        {{ $categoria->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <i class="fa-solid fa-chevron-down select-icon"></i>
                                        </div>
                                        @error('categoria')
                                            <div class="error-message">
                                                <i class="fa-solid fa-exclamation-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label for="preco" class="form-label-modern">
                                            Preço
                                            <span class="required">*</span>
                                        </label>
                                        <div class="input-group-modern">
                                            <span class="input-group-text-modern">R$</span>
                                            <input 
                                                type="text" 
                                                name="preco" 
                                                id="preco" 
                                                class="form-control-modern"
                                                placeholder="0,00" 
                                                value="{{ old('preco') }}" 
                                                required>
                                        </div>
                                        @error('preco')
                                            <div class="error-message">
                                                <i class="fa-solid fa-exclamation-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group-modern">
                                        <label for="descricao" class="form-label-modern">
                                            Descrição do Serviço
                                            <span class="required">*</span>
                                        </label>
                                        <textarea 
                                            name="descricao" 
                                            id="descricao" 
                                            class="form-control-modern textarea-modern" 
                                            rows="6"
                                            placeholder="Descreva detalhadamente seu serviço, incluindo o que está incluído, tempo estimado, materiais necessários..."
                                            maxlength="750" 
                                            required>{{ old('descricao') }}</textarea>
                                        <div class="form-help">
                                            <span class="char-counter">
                                                <span id="descricao-count">0</span>/750 caracteres
                                            </span>
                                        </div>
                                        @error('descricao')
                                            <div class="error-message">
                                                <i class="fa-solid fa-exclamation-circle me-2"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ações do formulário -->
                        <div class="form-actions">
                            <div class="d-flex gap-3 justify-content-end flex-wrap">
                                <x-btn variant="branco" type="button" onclick="window.location='{{ route('dashboard') }}'">
                                    <i class="fa-solid fa-times me-2"></i>
                                    Cancelar
                                </x-btn>
                                <x-btn variant="verde" type="submit" size="large" class="btn-save">
                                    <i class="fa-solid fa-save me-2"></i>
                                    Cadastrar Serviço
                                </x-btn>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

