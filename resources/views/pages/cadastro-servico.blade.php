@extends('layouts.autenticado')
@section('title', 'Cadastrar Serviço')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 900px">
            <h1 class="text-center mb-4">Cadastrar Serviço</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('servico.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Nome do serviço --}}
                    <div class="col-md-12 mb-3">
                        <label for="nome" class="form-label">Título do Serviço*</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                            placeholder="Insira o título do serviço" value="{{ old('nome') }}" minlength="20"
                            maxlength="40" required>
                        @error('nome')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Upload de imagem --}}
                    <div class="col-md-6 mb-3">
                        <label for="imagem" class="form-label">Imagem do Serviço*</label>
                        <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*" required>
                        @error('imagem')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Categoria --}}
                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoria*</label>
                        <select name="categoria" id="categoria" class="form-select" required>
                            <option value="">Escolha a categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Descrição --}}
                    <div class="col-md-12 mb-3">
                        <label for="descricao" class="form-label">Descrição*</label>
                        <textarea name="descricao" id="descricao" class="form-control" rows="5"
                            placeholder="Insira a descrição do serviço aqui mesmo" maxlength="750" required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
