@extends ('layouts.autenticado')
@section('title', 'Login')
@section('content')
    <div id="div-1" class="mb-5 mt-5">
        <h2 class="fs-1 mb-4 text-center">Sobre Nós</h2>
        <p class="fs-4">Olá! Somos um grupo sem fins lucrativos, afinal, o que importa para nós é aquela nota boa que
            devemos ter no final do semestre! Brincadeiras a parte, buscamos oferecer os melhores sistemas para cada
            contexto que os nossos clientes (no caso, o professor) solicitarem. Além disso, se quiser, revise os
            <a class="emphasis_text" href="{{ route('termos') }}">Termos de Compromisso e de Privacidade</a> que o site
            oferece aos nossos clientes.
        </p>
        <h2 class="fs-1 text-center">Integrantes</h2>
    </div>

    <div id="div-2" class="text-center fs-4">
        <div class="d-flex flex-wrap justify-content-center">


            <div class="mx-3">
                <div class="div_img_container">
                    <div class="div_img">
                        <a href="https://www.canva.com/design/DAGUUxX7zaI/UE0C7cubMNa5LDGTNDlgdw/edit?utm_content=DAGUUxX7zaI&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton"
                            target="_blank">
                            <img src="{{ asset('images/matheus.jpg') }}" class="rounded-circle"
                                alt="Foto do Matheus Pantoja de Morais">
                        </a>
                        <div class="hover_links">
                            <a href="https://github.com/KarmaWT" target="_blank" class="icon github" title="GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="https://www.canva.com/design/DAGUUxX7zaI/UE0C7cubMNa5LDGTNDlgdw/edit?utm_content=DAGUUxX7zaI&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton"
                                target="_blank" class="icon curriculo" title="Curriculo">
                                <i class="fas fa-file"></i>
                            </a>
                        </div>
                    </div>
                    <p class="text-center mt-2">Matheus Pantoja de Morais</p>
                </div>
            </div>



            <div class="mx-3">
                <div class="div_img_container">
                    <div class="div_img">
                        <a href="https://www.canva.com/design/DAGnLa3ishI/ic-hL6dDyn-07pl2zaVH1w/edit?utm_content=DAGnLa3ishI&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton"
                            target="_blank">
                            <img src="{{ asset('images/manoel.png') }}" class="rounded-circle"
                                alt="Foto do Manoel de Jesus Moreira de Aguiar">
                        </a>
                        <div class="hover_links">
                            <a href="https://www.canva.com/design/DAGnLa3ishI/ic-hL6dDyn-07pl2zaVH1w/edit?utm_content=DAGnLa3ishI&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton"
                                target="_blank" class="icon curriculo" title="Curriculo">
                                <i class="fas fa-file"></i>
                            </a>
                        </div>
                    </div>
                    <p class="text-center mt-2">Manoel de Jesus Moreira de Aguiar</p>
                </div>
            </div>

            <div class="mx-3">
                <div class="div_img_container">
                    <div class="div_img">
                        <a href="https://github.com/JClaion" target="_blank">
                            <img src="{{ asset('images/claion.png') }}" class="rounded-circle"
                                alt="Foto do José Claion Martins de Sousa">
                        </a>
                        <div class="hover_links">
                            <a href="https://github.com/JClaion" target="_blank" class="icon github" title="GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                    <p class="text-center mt-2">José Claion Martins de Sousa</p>
                </div>
            </div>

            <div class="mx-3">
                <div class="div_img_container">
                    <div class="div_img">
                        <a href="https://www.canva.com/design/DAF-2lbgVCA/ImVa15Jxaakq0Ii2Zk2tag/edit?utm_content=DAF-2lbgVCA&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton"
                            target="_blank">
                            <img src="{{ asset('images/joao.png') }}" class="rounded-circle"
                                alt="Foto do João Victor Brum de Castro">
                        </a>
                        <div class="hover_links">
                            <a href="https://www.canva.com/design/DAF-2lbgVCA/ImVa15Jxaakq0Ii2Zk2tag/edit?utm_content=DAF-2lbgVCA&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton"
                                target="_blank" class="icon curriculo" title="Curriculo">
                                <i class="fas fa-file"></i>
                            </a>
                        </div>
                    </div>
                    <p class="text-center mt-2">João Victor Brum de Castro</p>
                </div>
            </div>
        </div>
    </div>
@endsection