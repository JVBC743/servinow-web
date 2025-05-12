<!DOCTYPE html>
<html>
<head>
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="{{ asset('css/photos.css') }}"> <!-- Verificar se precisa usar o vite ou não -->
    <link rel="stylesheet" href="{{  asset('css/fonts-and-texts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default_page_style.css') }}">
</head>
<body>
    <p class = "big_text">Sobre Nós</p>
    
    <p id = "text_general">Olá! Somos um grupo sem fins lucrativos, afinal, o que importa para nós é aquela nota boa que devemos ter no final do semestre! Brincadeiras a parte, buscamos oferecer os melhores sistemas para cada contexto que os nossos clientes (no caso, o professor) solicitarem. Além disso, se quiser, revise os 
        <a href="{{ route('termos') }}" class = "links">Termos de Compromisso e de Privacidade</a> que o site oferece aos nossos clientes.</p>
    <p class = "big_text">Integrantes</p>
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
</body>
</html>