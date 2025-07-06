@extends ('layouts.nao-autenticado')
@section('title', 'Login')
@section('content')
    <div class="container-fluid bg-gradient d-flex justify-content-center align-items-center min-vh-100">
        <div class="main-box d-flex flex-wrap">
            <!-- Coluna Esquerda -->
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                <div class="login-box text-center">
                    <h1 class="login-title fs-1">Login</h1>
                    <br>
                    <hr class="divisor">
                    <br>
                    <form>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" placeholder="Senha">
                        </div>

                        <div class="mb-3 text-end">
                            <a href="" class="esqueci-senha">Esqueci minha senha?</a>
                        </div>

                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('cadastro.form') }}" class="btn btn-cadastrar">Cadastrar</a>
                            <a href="{{ route('lista-avaliacoes') }}" class="btn btn-entrar">Entrar</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Coluna Direita -->
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-4">
                <img src="{{ asset('images/logo.png') }}" class="img-fluid mb-3" style="width: 90%;" alt="Logo">
                <p class="fs-5">
                    ServiNow é a ponte entre quem precisa e quem faz. Uma plataforma segura, acessível e intuitiva que
                    conecta clientes a prestadores de serviços de diversas áreas. Agende com facilidade, atenda com
                    eficiência, tudo em um só lugar.
                </p>
            </div>
        </div>
    </div>
@endsection