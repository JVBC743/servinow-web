<!DOCTYPE html>
<html>
<head>
    <title>Edição do Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{  asset('css/photos.css') }}">

</head>
<body id="body">
    <h1>Configuração de Conta</h1>
    <form action="">
        <div class="d-flex" >
            <div class="my-3">
                <input type="text" placeholder="Nome"><br>
                <input type="text" placeholder="E-mail"><br>
                <input type="text" placeholder="Telefone"><br>
                <input type="text" placeholder="Área de atuação"><br>
                <input type="text" placeholder="CPF/CNPJ"><br>
            </div>
            <div class="my-3">
                <input type="text" placeholder="Rede social #1"><br>
                <input type="text" placeholder="Rede social #2"><br>
                <input type="text" placeholder="Rede social #3"><br>
                <input type="text" placeholder="Rede social #4"><br>
                <div id = "div-foto">
                    <input type="image">
                </div>
            </div>
        </div>
        
        {{ $nome_foto = "teste" }}

        <input type="submit" value="Salvar">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>