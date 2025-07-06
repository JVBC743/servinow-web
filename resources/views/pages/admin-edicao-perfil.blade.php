@extends('layouts.autenticado')

@section('title', 'Editar Perfil')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 900px">

            <h1 class="text-center mb-4">Editar Perfil</h1>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($editarUsuario)
                <form action="{{ route('admin.usuario.edit', $editarUsuario->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Nome --}}
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Nome*</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $editarUsuario->nome) }}" maxlength="50" required>
                        </div>

                        {{-- E-mail --}}
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">E-mail*</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $editarUsuario->email) }}" maxlength="80" required>
                        </div>

                        {{-- Telefone --}}
                        <div class="col-md-6 mb-3">
                            <label for="telefone" class="form-label">Telefone*</label>
                            <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone', $editarUsuario->telefone) }}" maxlength="15" required>
                        </div>

                        {{-- Área de Atuação --}}
                        <div class="col-md-6 mb-3">
                            <label for="area_atuacao" class="form-label">Área de Atuação*</label>
                            <select name="area_atuacao" id="area_atuacao" class="form-select" required>
                                <option value="">Selecione a sua formação</option>
                                @foreach ($lista as $formacao)
                                    <option value="{{ $formacao->id }}" {{ old('area_atuacao', $editarUsuario->area_atuacao) == $formacao->id ? 'selected' : '' }}>
                                        {{ $formacao->formacao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Descrição --}}
                        <div class="col-12 mb-3">
                            <label for="descricao" class="form-label">Descrição (max 300 caracteres)</label>
                            <textarea name="descricao" id="descricao" class="form-control" maxlength="300" rows="4" placeholder="Adicione uma breve descrição das suas competências">{{ old('descricao', $editarUsuario->descricao) }}</textarea>
                        </div>

                        {{-- Redes sociais --}}
                        <div class="col-md-6 mb-3">
                            <label for="rede_social1" class="form-label">Rede social #1</label>
                            <input type="text" name="rede_social1" id="rede_social1" class="form-control" maxlength="40" value="{{ old('rede_social1', $editarUsuario->rede_social1) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rede_social2" class="form-label">Rede social #2</label>
                            <input type="text" name="rede_social2" id="rede_social2" class="form-control" maxlength="40" value="{{ old('rede_social2', $editarUsuario->rede_social2) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rede_social3" class="form-label">Rede social #3</label>
                            <input type="text" name="rede_social3" id="rede_social3" class="form-control" maxlength="40" value="{{ old('rede_social3', $editarUsuario->rede_social3) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rede_social4" class="form-label">Rede social #4</label>
                            <input type="text" name="rede_social4" id="rede_social4" class="form-control" maxlength="40" value="{{ old('rede_social4', $editarUsuario->rede_social4) }}">
                        </div>

                        {{-- Imagem --}}
                        <div class="d-flex justify-content-center mt-5 mb-3">
                            <div class="d-flex flex-column align-items-center" style="width: 200px;">
                                <div class="d-flex flex-column align-items-center" style="width: 200px;">
                                    @if($imagem_url)
                                        <img src="{{ $imagem_url }}" alt="Foto do usuário" class="profile_img mb-3" style="width: 400px">
                                    @else
                                        <img src="{{ asset('images/user-icon.png') }}" alt="Usuário sem foto" class="profile_img mb-3" style="width: 400px">
                                    @endif
                                    <input type="file" name="foto" accept="image/*" class="form-control w-100" style="max-width: 150px;">
                                    <small class="text-muted mt-1">Anexar nova imagem</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4 w-100">
                        <button type="submit" class="btn btn-primary px-5">Salvar</button>
                    </div>
                </form>
            @else
                <h3 class="text-center text-danger">Usuário não encontrado, por favor, volte.</h3>
            @endif
        </div>
    </div>
@endsection
