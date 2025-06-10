<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ServiNow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .bg-gradient {
            background: linear-gradient(to bottom, #4879BF, #7FBFC9) !important;
            padding: 30px;
        }

        .main-box {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 75px;
            width: 90vw;
            height: 90vh;
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
        }

        .login-box {
            background-color: white;
            width: 70%;
            aspect-ratio: 3 / 3;
            padding: 20px;
            margin: 20px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: relative;
        }

        .login-title {
            background: linear-gradient(to bottom, #4879BF, #7FBFC9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            font-size: 2.5rem;
            text-align: center;
            margin-top: 0;
        }

        .divisor {
            border: 1px solid #888;
            width: 100%;
            margin: 0;
            margin-bottom: 20px;
        }

        .esqueci-senha {
            text-decoration: none;
            font-size: 0.9rem;
            color: #333;
        }

        .bg-lightgray {
            background-color: #ccc !important;
        }

        .descricao {
            color: #000;
            max-width: 90%;
            font-size: 1rem;
        }

        .btn-cadastrar,
        .btn-entrar {
            width: 120px;
            transition: all 0.3s ease;
        }

        .btn-cadastrar {
            background-color: white;
            color: black;
            border: 1px solid black;
        }

        .btn-cadastrar:hover {
            background-color: #ccc;
            color: black;
            border: 1px solid black;
        }

        .btn-entrar {
            background: linear-gradient(to bottom, #21a7a7, #006e92);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
            color: black;
            border: 1px solid black;
        }

        .btn-entrar:hover {
            background: linear-gradient(to right, #006e92,rgb(33, 167, 167));
            color: black;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="container-fluid bg-gradient d-flex justify-content-center align-items-center min-vh-100">
        <div class="main-box d-flex flex-wrap">
            <!-- Coluna Esquerda -->
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                <div class="login-box text-center">
                    <h1 class="login-title">Login</h1>
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
                            <a href="{{ route('cadastro') }}" class="btn btn-cadastrar">Cadastrar</a>
                            <a href="{{ route('dashboard') }}" class="btn btn-entrar">Entrar</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Coluna Direita -->
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-4">
                <img src="{{ asset('img/logo.png') }}" class="img-fluid mb-3" style="width: 90%;" alt="Logo">
                <p class="descricao">
                    ServiNow é a ponte entre quem precisa e quem faz. Uma plataforma segura, acessível e intuitiva que
                    conecta clientes a prestadores de serviços de diversas áreas. Agende com facilidade, atenda com
                    eficiência, tudo em um só lugar.
                </p>
            </div>
        </div>
    </div>

    <!-- Ícones Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>

</html>