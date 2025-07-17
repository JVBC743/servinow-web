@extends ('layouts.nao-autenticado')
@section('title', 'Cadastro')
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


    <div class="container-fluid bg-gradient d-flex justify-content-center align-items-center min-vh-100">

        <div class="container-principal" style="background-color: rgba(255, 255, 255, 0.75);">
            <div class="container-formulario d-flex justify-content-center align-items-center">
                <div class="formulario-area">
                    <h1 class="login-title fs-1">Tela de Cadastro</h1>

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
                        <div class="linha-input">
                            <div class="input-grupo">
                                <label for="nome">Nome<span>*</span></label>
                                <input type="text" id="nome" name="nome" value="{{ old('name') }}" required>
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo">
                                <label for="cpf">CPF<span>*</span></label>
                                <input type="text" id="cpf" name="cpf_cnpj" value="{{ old('cpf_cnpj') }}" required>
                                @error('cpf')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo">
                                <label for="data_nascimento">Data de nascimento<span>*</span></label>
                                <input type="date" id="data_nascimento" name="data_nascimento"
                                    value="{{ old('data_nascimento') }}" required>
                                @error('data_nascimento')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="linha-input">
                            <div class="input-grupo input-email">
                                <label for="email">E-mail<span>*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo">
                                <label for="celular">Número de telefone<span>*</span></label>
                                <input type="tel" id="celular" name="telefone" value="{{ old('telefone') }}" required>
                                @error('celular')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo">
                                <label for="cep">CEP<span>*</span></label>
                                <input type="text" id="cep" name="cep" value="{{ old('cep') }}" required>
                                @error('cep')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="linha-input">
                            <div class="input-grupo input-logradouro">
                                <label for="logradouro">Logradouro<span>*</span></label>
                                <input type="text" id="logradouro" name="logradouro" value="{{ old('logradouro') }}"
                                    required>
                                @error('logradouro')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo input-numero">
                                <label for="numero">Número<span>*</span></label>
                                <input type="text" id="numero" name="numero" value="{{ old('numero') }}" required>
                                @error('numero')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo input-complemento">
                                <label for="complemento">Complemento</label>
                                <input type="text" id="complemento" name="complemento" value="{{ old('complemento') }}">
                                @error('complemento')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo input-bairro">
                                <label for="bairro">Bairro<span>*</span></label>
                                <input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}" required>
                                @error('bairro')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="linha-input">
                            <div class="input-grupo input-cidade">
                                <label for="cidade">Cidade<span>*</span></label>
                                <input type="text" id="cidade" name="cidade" value="{{ old('cidade') }}" required>
                                @error('cidade')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo input-uf">
                                <label for="uf">UF<span>*</span></label>
                                <input type="text" id="uf" name="uf" maxlength="2" value="{{ old('uf') }}" required>
                                @error('uf')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo">
                                <label for="senha">Senha<span>*</span></label>
                                <input type="password" id="senha" name="password" required>
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="input-grupo">
                                <label for="repetir_senha">Repetir senha<span>*</span></label>
                                <input type="password" id="repetir_senha" name="password_confirmation" required>
                            </div>
                        </div>
                        <p class="termos">
                            Ao clicar em Cadastre-se, você concorda com nossos <a
                        href="{{ route('termos') }}">Termos, Política de Privacidade e Política de Cookies</a>. Você poderá
                            receber notificações por SMS e cancelar isso quando quiser.
                        </p>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-cadastrar">Cadastrar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection