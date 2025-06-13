<x-navbar :title="'Edição de perfil'" />

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
                        {{-- <input class = "mb-3" type="text" placeholder="Área de atuação" name="area_atuacao" value="{{ $editarUsuario->nome_atuacao ?? '' }}"><br> --}}

                        <select name="area_atuacao" id="">
                            <option value="">Selecione a sua formação</option>
                            @foreach ($lista as $formacao)
                                <option value="{{ $formacao['id'] }}" {{$editarUsuario->area_atuacao == $formacao['id'] ? 'selected' : ''}}>
                                    {{ $formacao['formacao'] }}
                            @endforeach
                            </option>
                        </select>

                        <div>
                            <p style="font-size: 15px">Anexar imagem</p>
                            <input alt="Enviar imagem"type="image" class = "img_input" style="width: 150px; height: 50px">
                        </div>
                    </div>
                    <div class="my-3 inputs_2">
                        <input class = "mb-3" type="text" placeholder="Rede social #1" name="rede_social1" value="{{ $editarUsuario->rede_social1 ?? '' }}"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #2" name="rede_social2" value="{{ $editarUsuario->rede_social2 ?? '' }}"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #3" name="rede_social3" value="{{ $editarUsuario->rede_social3 ?? '' }}"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #4" name="rede_social4" value="{{ $editarUsuario->rede_social4 ?? '' }}"><br>
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
        <h1>Erro ao procurar o usuário.</h1>
    @endif


    <x-footer />

</body>
</html>