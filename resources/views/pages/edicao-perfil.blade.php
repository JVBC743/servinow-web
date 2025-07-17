    @extends('layouts.autenticado')

    @section('title', 'Editar Perfil')

    @section('content')
        <div class="container-fluid d-flex justify-content-center align-items-center py-5">
            <div class="card p-4 shadow w-100" style="max-width: 900px">

                <h1 class="text-center mb-4">Editar Perfil</h1>

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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($usr)
                    <form action="{{ route('editar.usuario', $usr->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Nome --}}
                            <div class="col-md-6 mb-3">
                                <label for="nome" class="form-label">Nome*</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $usr->nome) }}" maxlength="50" required>
                            </div>

                            {{-- E-mail --}}
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail*</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usr->email) }}" maxlength="80" required>
                            </div>

                            {{-- Telefone --}}
                            <div class="col-md-6 mb-3">
                                <label for="telefone" class="form-label">Telefone*</label>
                                <input type="text" name="telefone" id="celular" class="form-control" value="{{ old('telefone', $usr->telefone) }}" maxlength="15" required>
                            </div>

                            {{-- Área de Atuação --}}
                            <div class="col-md-6 mb-3">
                                <label for="area_atuacao" class="form-label">Área de Atuação*</label>
                                <select name="area_atuacao" id="area_atuacao" class="form-select" required>
                                    <option value="">Selecione a sua formação</option>
                                    @foreach ($lista as $formacao)
                                        <option value="{{ $formacao->id }}" {{ old('area_atuacao', $usr->area_atuacao) == $formacao->id ? 'selected' : '' }}>
                                            {{ $formacao->formacao }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Descrição --}}
                            <div class="col-12 mb-3">
                                <label for="descricao" class="form-label">Descrição (max 300 caracteres)</label>
                                <textarea name="descricao" id="descricao" class="form-control" maxlength="300" rows="4" placeholder="Adicione uma breve descrição das suas competências">{{ old('descricao', $usr->descricao) }}</textarea>
                            </div>

                            {{-- Substituindo redes sociais por campos de endereço --}}

                            <div class="col-md-6 mb-3">
                                <label for="cep" class="form-label">CEP*</label>
                                <input type="text" name="cep" id="cep" class="form-control" maxlength="10" value="{{ old('cep', $usr->cep ?? '') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="logradouro" class="form-label">Logradouro*</label>
                                <input type="text" name="logradouro" id="logradouro" class="form-control" value="{{ old('logradouro', $usr->logradouro ?? '') }}" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="numero" class="form-label">Número*</label>
                                <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero', $usr->numero ?? '') }}" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" name="complemento" id="complemento" class="form-control" value="{{ old('complemento', $usr->complemento ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="bairro" class="form-label">Bairro*</label>
                                <input type="text" name="bairro" id="bairro" class="form-control" value="{{ old('bairro', $usr->bairro ?? '') }}" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="cidade" class="form-label">Cidade*</label>
                                <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade', $usr->cidade ?? '') }}" required>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="uf" class="form-label">UF*</label>
                                <input type="text" name="uf" id="uf" maxlength="2" class="form-control" value="{{ old('uf', $usr->uf ?? '') }}" required>
                            </div>



                            {{-- Imagem --}}
                            <div class="d-flex justify-content-center mt-5 mb-3">
                                <div class="d-flex flex-column align-items-center">
                                    @if($imagem_url)
                                        <img src="{{ $imagem_url }}" alt="Foto do usuário" class="profile_img mb-3" style="width: 400px">
                                    @else
                                        <img src="{{ asset('images/user-icon.png') }}" alt="Usuário sem foto" class="profile_img mb-3" style="width: 400px">
                                    @endif
                                    <input type="file" name="foto" accept="image/*" class="form-control w-100">
                                    <small class="text-muted mt-1">Anexar nova imagem</small>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex justify-content-center mt-4 w-100">
                                <a href="{{ route('visualizacao.perfil')  }}" class="btn btn-secondary px-5">Desfazer</a>
                            </div>
                            <div class="d-flex justify-content-center mt-4 w-100">
                                <button type="submit" class="btn btn-primary px-5 btn-geral">Salvar</button>
                            </div>
                        </div>
                        
                    </form>
                @else
                    <h3 class="text-center text-danger">Usuário não encontrado, por favor, volte.</h3>
                @endif
            </div>
        </div>
    @endsection
