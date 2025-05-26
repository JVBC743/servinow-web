<!DOCTYPE html>
<html>
<head>
    <title>Edição do Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{  asset('css/photos.css') }}">
    <link rel="stylesheet" href="{{  asset('css/sizes.css') }}">


</head>
<body id="body">

    <h1 class="ms-5 mt-4">Configuração de Conta</h1>

    <form action="">
        <div class="d-flex" >
            <div class="my-3 mx-5 inputs">
                <input class = "mb-3" type="text" placeholder="Nome"><br>
                <input class = "mb-3" type="text" placeholder="E-mail"><br>
                <input class = "mb-3" type="text" placeholder="Telefone"><br>
                <input class = "mb-3" type="text" placeholder="Área de atuação"><br>
                <input class = "mb-3" type="text" placeholder="CPF/CNPJ"><br>
                <div id = "img_div" >
                    <input type="image" style="width: 200px; height:40px;">
                </div>
            </div>
            <div class="my-3 inputs_2">
                <input class = "mb-3" type="text" placeholder="Rede social #1"><br>
                <input class = "mb-3" type="text" placeholder="Rede social #2"><br>
                <input class = "mb-3" type="text" placeholder="Rede social #3"><br>
                <input class = "mb-3" type="text" placeholder="Rede social #4"><br>
                
            </div>
        </div>
        

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>