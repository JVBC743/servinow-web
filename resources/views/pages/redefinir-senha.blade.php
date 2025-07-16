@extends('layouts.nao-autenticado')

@section('title', 'Redefinir senha')

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

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <h4 class="card-title mb-4 text-center">Redefinir Senha</h4>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
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

                <form method="POST" action="{{ route('post.redefinir.senha') }}" id="form-redefinir" novalidate>
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="telefone" value="{{ $telefone }}">


                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" name="password" id="password" required
                            aria-describedby="passwordHelpBlock passwordError">
                        <div id="passwordHelpBlock" class="form-text">
                            A senha deve ter no mínimo 8 caracteres, incluindo um número, uma letra e um caractere especial.
                        </div>
                        <span id="passwordError" class="text-danger small d-none"></span>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                            required aria-describedby="confirmPasswordError">
                        <span id="confirmPasswordError" class="text-danger small d-none"></span>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Redefinir Senha</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const form = document.getElementById('form-redefinir');
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');

        function validarSenha() {
            const senha = passwordInput.value;
            const regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/;
            if (!regex.test(senha)) {
                passwordError.textContent = 'Senha deve ter mínimo 8 caracteres, com letras, números e caractere especial.';
                passwordError.classList.remove('d-none');
                return false;
            } else {
                passwordError.textContent = '';
                passwordError.classList.add('d-none');
                return true;
            }
        }

        function validarConfirmacao() {
            if (passwordInput.value !== confirmInput.value) {
                confirmPasswordError.textContent = 'As senhas não coincidem.';
                confirmPasswordError.classList.remove('d-none');
                return false;
            } else {
                confirmPasswordError.textContent = '';
                confirmPasswordError.classList.add('d-none');
                return true;
            }
        }

        passwordInput.addEventListener('input', () => {
            validarSenha();
            validarConfirmacao(); // também valida confirmação para atualizar em tempo real
        });

        confirmInput.addEventListener('input', validarConfirmacao);

        form.addEventListener('submit', function(e) {
            const senhaValida = validarSenha();
            const confirmacaoValida = validarConfirmacao();

            if (!senhaValida || !confirmacaoValida) {
                e.preventDefault();
            }
        });
    </script>
@endsection
