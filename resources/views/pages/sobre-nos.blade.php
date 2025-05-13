<!DOCTYPE html>
<html>
<head>
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>
<body class = "mx-6">
    <h2 class = "empashis_text">Sobre Nós</h2>
    
    <p id = "text_general" class="fs-1">Olá! Somos um grupo sem fins lucrativos, afinal, o que importa para nós é aquela nota boa que devemos ter no final do semestre! Brincadeiras a parte, buscamos oferecer os melhores sistemas para cada contexto que os nossos clientes (no caso, o professor) solicitarem. Além disso, se quiser, revise os 
        <a href="{{ route('termos') }}" class = "empashis_text">Termos de Compromisso e de Privacidade</a> que o site oferece aos nossos clientes.</p>
    <h2 class = "empashis_text">Integrantes</h2>
    <div id = "photos">
        <div class = "div-name-photo">
            <a href="https://github.com/KarmaWT" target="_blank">
                <img class = "photo-1" src="{{ asset('images/pantoja.png') }}" alt="Foto do Matheus Pantoja">
            </a><br>
            <p>Matheus Pantoja de Morais</p>
        </div>
        <div class = "div-name-photo">        
            <a href="https://github.com/JClaion" target="_blank">
                <img class = "photo-1" src="{{ asset('images/claion.png') }}" alt="Foto do José Claion">    
            </a><br>
            <p>José Claion Martins de Sousa</p>
        </div>
        <div class = "div-name-photo">
            <a href="" target="_blank">
                <img class = "photo-2" src="{{ asset('images/manoel.png') }}" alt="Foto do Manoel Aguiar">
            </a><br>
            <p>Manoel de Jesus Moreira de Aguiar</p>
        </div>
        <div class = "div-name-photo">
            <a href="https://www.canva.com/design/DAF-2lbgVCA/ImVa15Jxaakq0Ii2Zk2tag/edit?utm_content=DAF-2lbgVCA&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton" target="_blank">
                <img class = "photo-2" src="{{ asset('images/joao.png') }}" alt="Foto do João Victor">
            </a><br>
            <p>João Victor Brum de Castro</p>
        </div>
    </div>

    <h1>Mudar a altura dos nomese do photo-2</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>