<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Seu CSS -->
    <link href="{{ asset('css/fonts/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-principal">
        <div class="container-formulario">
            <div class="logo-area">
                <div class="logo-placeholder">ServiNow</div>
                <p class="texto-logo">Texto aqui!</p>
            </div>
            <div class="formulario-area">
                <h1>Tela de Cadastro</h1>
                <form action="{{-- {{ route('sua.rota.de.cadastro') }} --}}" method="POST">
                    @csrf <div class="linha-input">
                        <div class="input-grupo">
                            <label for="nome">Nome*</label>
                            <input type="text" id="nome" name="nome" required>
                        </div>
                        <div class="input-grupo">
                            <label for="cpf">CPF*</label>
                            <input type="text" id="cpf" name="cpf" required>
                        </div>
                        <div class="input-grupo">
                            <label for="data_nascimento">Data de nascimento*</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" required>
                        </div>
                    </div>

                    <div class="linha-input">
                        <div class="input-grupo input-email">
                            <label for="email">E-mail*</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="input-grupo">
                            <label for="celular">Número de celular*</label>
                            <input type="tel" id="celular" name="celular" required>
                        </div>
                        <div class="input-grupo">
                            <label for="cep">CEP*</label>
                            <input type="text" id="cep" name="cep" required>
                        </div>
                    </div>

                    <div class="linha-input">
                        <div class="input-grupo input-logradouro">
                            <label for="logradouro">Logradouro*</label>
                            <input type="text" id="logradouro" name="logradouro" required>
                        </div>
                        <div class="input-grupo input-numero">
                            <label for="numero">Número*</label>
                            <input type="text" id="numero" name="numero" required>
                        </div>
                        <div class="input-grupo input-complemento">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" name="complemento">
                        </div>
                         <div class="input-grupo input-bairro">
                            <label for="bairro">Bairro*</label>
                            <input type="text" id="bairro" name="bairro" required>
                        </div>
                    </div>

                    <div class="linha-input">
                        <div class="input-grupo input-cidade">
                            <label for="cidade">Cidade*</label>
                            <input type="text" id="cidade" name="cidade" required>
                        </div>
                        <div class="input-grupo input-uf">
                            <label for="uf">UF*</label>
                            <input type="text" id="uf" name="uf" maxlength="2" required>
                        </div>
                        <div class="input-grupo">
                            <label for="senha">Senha*</label>
                            <input type="password" id="senha" name="password" required>
                        </div>
                        <div class="input-grupo">
                            <label for="repetir_senha">Repetir senha*</label>
                            <input type="password" id="repetir_senha" name="password_confirmation" required>
                        </div>
                    </div>

                    <p class="termos">
                        As pessoas que usam nosso serviço podem ter carregado suas informações de contato no Medium. <a href="#">Saiba mais</a>.
                    </p>
                    <p class="termos">
                        Ao clicar em Cadastre-se, você concorda com nossos <a href="#">Termos</a>, <a href="#">Política de Privacidade</a> e <a href="#">Política de Cookies</a>. Você poderá receber notificações por SMS e cancelar isso quando quiser.
                    </p>

                    <button type="submit" class="btn-cadastrar">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
<script src="{{ asset('js/script.js') }}"></script>
</html>