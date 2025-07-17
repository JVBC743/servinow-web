@extends ('layouts.nao-autenticado')
@section('title', 'Cadastro')
@section('content')
    <div class="container-fluid bg-gradient d-flex justify-content-center align-items-center min-vh-100">
<<<<<<< Updated upstream

        <div class="formulario-area">
            <h1>Tela de Cadastro</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
=======
                  
                <div class="formulario-area">
                    <h1>Tela de Cadastro</h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('cadastro.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome<span class="text-danger fw-bold">*</span></label>
                            <input type="text" id="nome" name="nome" class="form-control" value="{{ old('name') }}" required>
                            @error('name')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <label for="cpf" class="form-label">CPF/CNPJ<span class="text-danger fw-bold">*</span></label>
                            <input type="text" id="cpf" name="cpf_cnpj" class="form-control" value="{{ old('cpf') }}" required>
                            @error('cpf_cnpj')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <label for="data_nascimento" class="form-label">Data de nascimento<span class="text-danger fw-bold">*</span></label>
                            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}" required>
                            @error('data_nascimento')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Nome<span class="text-danger fw-bold">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                @error('email')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="celular" class="form-label">Número de telefone<span class="text-danger fw-bold">*</span></label>
                                <input type="tel" id="celular" name="telefone"class="form-control" value="{{ old('telefone') }}" required>
                                @error('celular')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo">
                                <label for="cep" class="form-label">CEP<span class="text-danger fw-bold">*</span></label>
                                <input type="text" id="cep" name="cep" class="form-control" value="{{ old('cep') }}" required>
                                @error('cep')<span class="text-danger mt-1 d-block"">{{ $message }}</span>@enderror
                            </div>
                        </div>

                       <div class="row mb-3">
                        <div class="col-md-5">
                            <label for="logradouro" class="form-label">Logradouro<span class="text-danger fw-bold">*</span></label>
                            <input type="text" id="logradouro" name="logradouro" class="form-control" value="{{ old('logradouro') }}" required>
                            @error('logradouro')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-2">
                            <label for="numero" class="form-label">Número<span class="text-danger fw-bold">*</span></label>
                            <input type="text" id="numero" name="numero" class="form-control" value="{{ old('numero') }}" required>
                            @error('numero')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-2">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" id="complemento" name="complemento" class="form-control" value="{{ old('complemento') }}">
                            @error('complemento')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <label for="bairro" class="form-label">Bairro<span class="text-danger fw-bold">*</span></label>
                            <input type="text" id="bairro" name="bairro" class="form-control" value="{{ old('bairro') }}" required>
                            @error('bairro')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        </div>

                        <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="cidade" class="form-label">Cidade<span class="text-danger fw-bold">*</span></label>
                            <input type="text" id="cidade" name="cidade" class="form-control" value="{{ old('cidade') }}" required>
                            @error('cidade')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-2">
                            <label for="uf" class="form-label">UF<span class="text-danger fw-bold">*</span></label>
                            <input type="text" id="uf" name="uf" class="form-control" maxlength="2" value="{{ old('uf') }}" required>
                            @error('uf')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <label for="senha" class="form-label">Senha<span class="text-danger fw-bold">*</span></label>
                            <input type="password" id="senha" name="password" class="form-control" required>
                            @error('password')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <label for="repetir_senha" class="form-label">Repetir senha<span class="text-danger fw-bold">*</span></label>
                            <input type="password" id="repetir_senha" name="password_confirmation" class="form-control" required>
                        </div>
                        </div>

                        <p class="termos">
                            As pessoas que usam nosso serviço podem ter carregado suas informações de contato no Medium.
                            <a href="#">Saiba mais</a>.
                        </p>
                        <p class="termos">
                            Ao clicar em Cadastre-se, você concorda com nossos <a href="#">Termos</a>, <a
                                href="#">Política de Privacidade</a> e <a href="#">Política de Cookies</a>. Você poderá
                            receber notificações por SMS e cancelar isso quando quiser.
                        </p>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-cadastrar">Cadastrar</button>
                        </div>

                    </form>
>>>>>>> Stashed changes
                </div>
            @endif

            <form action="{{ route('cadastro.store') }}" method="POST">
                @csrf

                {{-- Linha 1: Nome, CPF, Data de Nascimento --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nome" class="form-label">Nome<span class="text-danger fw-bold">*</span></label>
                        <input type="text" id="nome" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="cpf" class="form-label">CPF<span class="text-danger fw-bold">*</span></label>
                        <input type="text" id="cpf" name="cpf" class="form-control" value="{{ old('cpf') }}" required>
                        @error('cpf')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="data_nascimento" class="form-label">Data de nascimento<span class="text-danger fw-bold">*</span></label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}" required>
                        @error('data_nascimento')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                </div>

                {{-- Linha 2: E-mail, Número de celular, CEP --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="email" class="form-label">E-mail<span class="text-danger fw-bold">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="celular" class="form-label">Número de celular<span class="text-danger fw-bold">*</span></label>
                        <input type="tel" id="celular" name="celular" class="form-control" value="{{ old('celular') }}" required>
                        @error('celular')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4">
                        <label for="cep" class="form-label">CEP<span class="text-danger fw-bold">*</span></label>
                        <input type="text" id="cep" name="cep" class="form-control" value="{{ old('cep') }}" required>
                        @error('cep')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                </div>

                {{-- Linha 3: Logradouro, Número, Complemento, Bairro --}}
                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="logradouro" class="form-label">Logradouro<span class="text-danger fw-bold">*</span></label>
                        <input type="text" id="logradouro" name="logradouro" class="form-control" value="{{ old('logradouro') }}" required>
                        @error('logradouro')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-2">
                        <label for="numero" class="form-label">Número<span class="text-danger fw-bold">*</span></label>
                        <input type="text" id="numero" name="numero" class="form-control" value="{{ old('numero') }}" required>
                        @error('numero')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-2">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" id="complemento" name="complemento" class="form-control" value="{{ old('complemento') }}">
                        @error('complemento')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="bairro" class="form-label">Bairro<span class="text-danger fw-bold">*</span></label>
                        <input type="text" id="bairro" name="bairro" class="form-control" value="{{ old('bairro') }}" required>
                        @error('bairro')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                </div>

                {{-- Linha 4: Cidade, UF, Senha, Repetir senha --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="cidade" class="form-label">Cidade<span class="text-danger fw-bold">*</span></label>
                        <input type="text" id="cidade" name="cidade" class="form-control" value="{{ old('cidade') }}" required>
                        @error('cidade')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-2">
                        <label for="uf" class="form-label">UF<span class="text-danger fw-bold">*</span></label>
                        <input type="text" id="uf" name="uf" class="form-control" maxlength="2" value="{{ old('uf') }}" required>
                        @error('uf')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="senha" class="form-label">Senha<span class="text-danger fw-bold">*</span></label>
                        <input type="password" id="senha" name="password" class="form-control" required>
                        @error('password')<span class="text-danger mt-1 d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-3">
                        <label for="repetir_senha" class="form-label">Repetir senha<span class="text-danger fw-bold">*</span></label>
                        <input type="password" id="repetir_senha" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <p class="termos">
                    As pessoas que usam nosso serviço podem ter carregado suas informações de contato no Medium.
                    <a href="#">Saiba mais</a>.
                </p>
                <p class="termos">
                    Ao clicar em Cadastre-se, você concorda com nossos <a href="#">Termos</a>, <a
                        href="#">Política de Privacidade</a> e <a href="#">Política de Cookies</a>. Você poderá
                    receber notificações por SMS e cancelar isso quando quiser.
                </p>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-cadastrar">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection