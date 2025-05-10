<!DOCTYPE html>
<html>
<head>
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="{{ asset('css/photos.css') }}"> <!-- Verificar se precisa usar o vite ou não -->
    <link rel="stylesheet" href="{{  asset('css/fonts-and-texts.css') }}">
</head>
<body>
    <h1 id = "cabecalho">Sobre Nós</h1>
    <p id = "texto">Olá! Somos um grupo sem fins lucrativos, afinal, o que importa para nós é aquela nota boa que devemos ter no final do semestre! Brincadeiras a parte, buscamos oferecer os melhores sistemas para cada contexto que os nossos clientes (no caso, o professor) solicitarem. Além disso, se quiser, revise os <a href="">Termos de Compromisso</a> e de <a href="">Privacidade</a> que o site oferece aos nossos clientes.</p>

    <img class = "photo-1" src="{{ asset('images/pantoja.png') }}" alt="Foto do Matheus Pantoja">
    <img class = "photo-1" src="{{ asset('images/claion.png') }}" alt="Foto do José Claion">
    <img class = "photo-2" src="{{ asset('images/manoel.png') }}" alt="Foto do Manoel Aguiar">
    <img class = "photo-2" src="{{ asset('images/joao.png') }}" alt="Foto do João Victor">



</body>
</html>


