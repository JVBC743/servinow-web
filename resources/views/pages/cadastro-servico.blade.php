@extends('layouts.autenticado')
@section('title', 'Cadastrar Serviço')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" />
    <style>
        .img-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1rem;
        }
        .img-preview {
            max-width: 100%;
            max-height: 250px;
            border-radius: 1rem;
            box-shadow: 0 0 10px #0002;
            margin-bottom: 1rem;
        }
        .card-modern {
            border-radius: 1.5rem;
            border: none;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            background: rgba(255,255,255,0.95);
        }
        .form-label {
            font-weight: 600;
        }
        .img-area {
            background: #f8f9fa;
            border-radius: 1rem;
            padding: 2rem 1rem 1rem 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px 0 rgba(31, 38, 135, 0.07);
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card card-modern shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4 fw-bold text-primary">
                            <i class="bi bi-plus-circle me-2"></i> Cadastrar Serviço
                        </h2>
                        <form action="{{ route('servico.store') }}" method="POST" enctype="multipart/form-data" id="form-servico">
                            @csrf

                            {{-- Área exclusiva para imagem --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="img-area text-center">
                                        <label for="imagem" class="form-label mb-2">Imagem do Serviço*</label>
                                        <div class="img-preview-container">
                                            <img id="img-preview" class="img-preview d-none" alt="Prévia da imagem" />
                                        </div>
                                        <input type="file" name="imagem" id="imagem" class="form-control mb-2" accept="image/*" required>
                                        @error('imagem')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Demais campos --}}
                            <div class="row g-4">
                                <div class="col-12">
                                    <label for="nome" class="form-label">Título do Serviço*</label>
                                    <input type="text" name="nome" id="nome" class="form-control"
                                        placeholder="Insira o título do serviço" value="{{ old('nome') }}" minlength="20"
                                        maxlength="40" required>
                                    @error('nome')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="categoria" class="form-label">Categoria*</label>
                                    <select name="categoria" id="categoria" class="form-select" required>
                                        <option value="">Escolha a categoria</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="preco" class="form-label">Preço (R$)*</label>
                                    <input type="number" name="preco" id="preco" class="form-control"
                                        placeholder="Ex: 99.90" value="{{ old('preco') }}" min="0" step="0.01" required>
                                    @error('preco')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="descricao" class="form-label">Descrição*</label>
                                    <textarea name="descricao" id="descricao" class="form-control" rows="5"
                                        placeholder="Insira a descrição do serviço aqui mesmo" maxlength="750" required>{{ old('descricao') }}</textarea>
                                    @error('descricao')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <x-btn variant="verde" type="submit" class="px-5 py-2 fs-5">
                                        <i class="bi bi-save me-2"></i> Salvar
                                    </x-btn>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const inputImagem = document.getElementById('imagem');
        const imgPreview = document.getElementById('img-preview');

        inputImagem.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    imgPreview.src = ev.target.result;
                    imgPreview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
