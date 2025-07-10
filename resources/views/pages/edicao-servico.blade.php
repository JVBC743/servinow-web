@extends('layouts.autenticado')
@section('title', 'Editar Serviço')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 900px">
            <h1 class="text-center mb-4">Editar Serviço</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Formulário principal: edição --}}
            <form action="{{ route('servico.update', $servico->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Nome do serviço --}}
                    <div class="col-md-12 mb-3">
                        <label for="nome" class="form-label">Título do Serviço*</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                            placeholder="Insira o título do serviço" value="{{ old('nome', $servico->nome_servico) }}"
                            minlength="20" maxlength="40" required>
                        @error('nome')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Upload de imagem --}}
                    <div class="col-md-6 mb-3">
                        <label for="imagem" class="form-label">Alterar Imagem do Serviço</label>
                        <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
                        @error('imagem')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        @if ($imagemUrl)
                            <div class="mt-3 text-center">
                                <p>Imagem atual:</p>
                                <img src="{{ $imagemUrl }}" alt="Imagem do Serviço" class="img-fluid mx-auto d-block"
                                    style="max-height: 200px;">
                            </div>
                        @endif

                    </div>

                    {{-- Categoria --}}
                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoria*</label>
                        <select name="categoria" id="categoria" class="form-select" required>
                            <option value="">Escolha a categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria', $servico->categoria) == $categoria->id ? 'selected' : '' }}>
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
                            placeholder="Insira a descrição do serviço aqui mesmo" maxlength="750" required>{{ old('descricao', $servico->desc_servico) }}</textarea>
                        @error('descricao')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 d-flex justify-content-between mt-4">
                        {{-- Botão desfazer (voltar à lista) --}}
                        <a href="{{ route('servicos.cadastrados') }}" class="btn btn-secondary">Desfazer</a>

                        {{-- Botão salvar --}}
                        <button type="submit" class="btn btn-primary btn-geral">Salvar</button>
                    </div>
                </div>
            </form>

            {{-- Formulário de exclusão separado --}}
            <form action="{{ route('servico.destroy', $servico->id) }}" method="POST" class="mt-3 text-end"
                onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    </div>
@endsection
