<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2 class="text-center mb-4">Tela de Cadastro</h2>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="birthDate" class="form-label">Data de nascimento</label>
                        <input type="date" name="birthDate" class="form-control" value="{{ old('birthDate') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="phone" class="form-label">Número de celular</label>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" name="cep" class="form-control" value="{{ old('cep') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Logradouro</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}" required disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="number" class="form-label">Número</label>
                        <input type="text" name="number" class="form-control" value="{{ old('number') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="complement" class="form-label">Complemento</label>
                        <input type="text" name="complement" class="form-control" value="{{ old('complement') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="neighborhood" class="form-label">Bairro</label>
                        <input type="text" name="neighborhood" class="form-control" value="{{ old('neighborhood') }}" required disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="city" class="form-label">Cidade</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city') }}" required disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="state" class="form-label">UF</label>
                        <input type="text" name="state" class="form-control" value="{{ old('state') }}" required disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmPassword" class="form-label">Repetir senha</label>
                        <input type="password" name="confirmPassword" class="form-control" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn register-btn">Cadastrar</button>
                </div>
                <p class="terms-text">
                    As pessoas que usam nosso serviço podem ter carregado suas informações de contato no Medium. Saiba mais.<br>
                    Ao clicar em Cadastre-se, você concorda com nossos Termos, Política de Privacidade e Política de Cookies. Você poderá receber notificações por SMS e cancelar isso quando quiser.
                </p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>