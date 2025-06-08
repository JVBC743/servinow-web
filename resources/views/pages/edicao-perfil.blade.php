<!DOCTYPE html>
<html>
<head>
    <title>Edição do Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sizes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
</head>
<body id="body">

    <h1 class="ms-5 mt-4">Configuração de Conta</h1>

    {{-- 670x727px --}}
    {{-- 359x727px --}}
    {{-- 330x727px --}}
    {{-- RESPONSIVIDADE VIA MEDIA QUERIES --}}

    @if($editarUsuario)

        <form action="{{ route('editar.usuario', $editarUsuario->id) }}" method="post">
            @csrf
            @METHOD('PUT')
            <div class="d-flex flex-wrap">
                <div class="d-flex fs-5 flex-wrap me-5">
                    <div class="my-3 mx-5 inputs">

                        <input class = "mb-3" type="text" placeholder="Nome" name="nome" value="{{ $editarUsuario->nome ?? '' }}"><br>
                        <input class = "mb-3" type="email" placeholder="E-mail" name="email" value="{{ $editarUsuario->email ?? '' }}"><br>
                        <input class = "mb-3" type="text" placeholder="Telefone" name="telefone" value="{{ $editarUsuario->telefone ?? '' }}"><br>
                        <input class = "mb-3" type="text" placeholder="Área de atuação" name="atuacao" value="{{ $editarUsuario->atuacao ?? '' }}"><br>
                        <div>
                            <p style="font-size: 15px">Anexar imagem</p>
                            <input alt="Enviar imagem"type="image" class = "img_input" style="width: 150px; height: 50px">
                        </div>
                    </div>
                    <div class="my-3 inputs_2">
                        <input class = "mb-3" type="text" placeholder="Rede social #1" name="rd1" value="{{ $editarUsuario->rede_social1 ?? '' }}"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #2" name="rd2" value="{{ $editarUsuario->rede_social2 ?? '' }}"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #3" name="rd3" value="{{ $editarUsuario->rede_social3 ?? '' }}"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #4" name="rd4" value="{{ $editarUsuario->rede_social4 ?? '' }}"><br>
                    </div>
                </div>
                <div class="ms-5 d-flex justify-content-center">
                    <div class="text-center fs-5">
                        <div class="">{{-- procurar saber como referenciar o caminho minio --}}
                            <img src="{{ $editarUsuario->caminho_img }}" alt="Foto do usuário na tela de edição de perfil." class="profile_image">
                        </div>
                        <div class="mb-3"></div>
                        <div class="photo_name fs-3">
                            {{ $nome_foto = "teste" }} PROCURAR CAMINHO AQUI
                        </div>
                        <div class="mt-4">
                            <input type="submit" value="Salvar" class="btn btn-primary button_save">
                        </div>
                    </div><br>
                </div>
            </div>
        </form>
    @else
        <h1>TESTE</h1>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>