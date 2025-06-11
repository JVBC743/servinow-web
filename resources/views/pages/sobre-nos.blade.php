<!DOCTYPE html>
<html>
<head>
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photos.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body id="body">
    <div id = "div-1" class = "mx-5 mb-5 mt-5">
        <h2 class="fs-1 mb-4 text-center">Sobre Nós</h2>
        
        <p class="fs-4">Olá! Somos um grupo sem fins lucrativos, afinal, o que importa para nós é aquela nota boa que devemos ter no final do semestre! Brincadeiras a parte, buscamos oferecer os melhores sistemas para cada contexto que os nossos clientes (no caso, o professor) solicitarem. Além disso, se quiser, revise os 
            <a class = "emphasis_text" href="{{ route('termos') }}">Termos de Compromisso e de Privacidade</a> que o site oferece aos nossos clientes.</p>
        <h2 class="fs-1 text-center">Integrantes</h2>
    </div>
    
    <div id = "div-2" class = "text-center fs-4">
        <div class = "d-flex flex-wrap justify-content-center">
            <div class = "mx-3">
                <div class="div_img">
                    <a href="https://github.com/KarmaWT" target="_blank">
                        <img src="{{ asset('images/pantoja.png') }}" class="rounded-circle" alt="Foto do Matheus Pantoja">
                    </a><br>
                </div>
                <p>Matheus Pantoja de Morais</p>
            </div>
            <div class = "mx-3">
                <div class="div_img">
                    <a href="https://github.com/JClaion" target="_blank">
                        <img src="{{ asset('images/claion.png') }}" class="rounded-circle" alt="Foto do José Claion">    
                    </a><br>
                </div>  
                
                <p>José Claion Martins de Sousa</p>
            </div>
            <div class = "mx-3">
                <div class="div_img">
                    <a href="" target="_blank">
                    <img src="{{ asset('images/manoel.png') }}" class="rounded-circle" alt="Foto do Manoel Aguiar">
                </a><br>
                </div>
                <p>Manoel de Jesus Moreira de Aguiar</p>
            </div>
            <div class = "mx-3">
                <div class="div_img">
                    <a href="https://www.canva.com/design/DAF-2lbgVCA/ImVa15Jxaakq0Ii2Zk2tag/edit?utm_content=DAF-2lbgVCA&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton" target="_blank">
                        <img src="{{ asset('images/joao.png') }}" class="rounded-circle" alt="Foto do João Victor">
                    </a>
                </div>
                <p>João Victor Brum de Castro</p>
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>