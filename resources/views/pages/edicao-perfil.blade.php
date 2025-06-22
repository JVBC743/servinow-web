
<x-header :title="'Editar Perfil'" />

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <h1 class="ms-5 mt-4">Configuração de Conta</h1>

    {{-- 670x727px --}}
    {{-- 359x727px --}}
    {{-- 330x727px --}}
    {{-- RESPONSIVIDADE VIA MEDIA QUERIES --}}
    {{-- VERIFICAR O PORQUE A FONTE NÃO PEGA VIA COMPONENTE. --}}

    @if($editarUsuario)
        <form action="{{ route('editar.usuario', $editarUsuario->id) }}" method="post">
            @csrf
            @METHOD('PUT')
            <div class="d-flex flex-wrap justify-content-between">
                <div class="d-flex fs-5 flex-wrap me-5">
                    <div class="my-3 mx-5 inputs">

                        <input class = "mb-3" type="text" placeholder="Nome" name="nome" value="{{ $editarUsuario->nome ?? '' }}" required maxlength="50"><br>
                        <input class = "mb-3" type="email" placeholder="E-mail" name="email" value="{{ $editarUsuario->email ?? '' }}" required maxlength="80"><br>
                        <input class = "mb-3" type="text" placeholder="Telefone" name="telefone" value="{{ $editarUsuario->telefone ?? '' }}" required maxlength="15"><br>
                        {{-- <input class = "mb-3" type="text" placeholder="Área de atuação" name="area_atuacao" value="{{ $editarUsuario->nome_atuacao ?? '' }}"><br> --}}

                        <select name="area_atuacao" id="" required>
                            <option value="">Selecione a sua formação</option>
                            @foreach ($lista as $formacao)
                                <option value="{{ $formacao['id'] }}" {{$editarUsuario->area_atuacao == $formacao['id'] ? 'selected' : ''}}>
                                    {{ $formacao['formacao'] }}
                            @endforeach
                            </option>
                        </select>

                        <div>
                            <p style="font-size: 15px">Anexar imagem</p>
                            <input name="foto" alt="Enviar imagem"type="image" class = "img_input" style="width: 150px; height: 50px">
                        </div>
                        <div>
                            <textarea type="text" name="descricao" class="my-3 inputs_desc" alt="" placeholder="Adicione aqui uma breve descrição das suas competências, seu limite é de 300 caracteres" maxlength="300"></textarea>
                        
                        </div>
                    </div>
                    <div class="my-3 inputs_2">
                        <input class = "mb-3" type="text" placeholder="Rede social #1" name="rede_social1" value="{{ $editarUsuario->rede_social1 ?? '' }}" maxlength="40"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #2" name="rede_social2" value="{{ $editarUsuario->rede_social2 ?? '' }}" maxlength="40"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #3" name="rede_social3" value="{{ $editarUsuario->rede_social3 ?? '' }}" maxlength="40"><br>
                        <input class = "mb-3" type="text" placeholder="Rede social #4" name="rede_social4" value="{{ $editarUsuario->rede_social4 ?? '' }}" maxlength="40"><br>
                    </div>
                </div>
                <div class="justify-content-end mx-5">
                    <div class="text-center fs-5">
                        <div class="">{{-- procurar saber como referenciar o caminho minio --}}
                            <img src="{{ $editarUsuario->caminho_img }}" alt="Foto do usuário na tela de edição de perfil." class="profile_image">
                        </div>
                        <div class="mb-3"></div>
                        <div class="photo_name fs-3">
                            {{ $nome_foto = "teste" }} PROCURAR CAMINHO AQUI
                        </div>
                        
                        <div class="mt-4 button_save">
                            <input type="submit" value="Salvar" class="">
                        </div>
                    </div><br>
                </div>
            </div>
        </form>
        <form action="" method="post">
            @csrf
            @method('DELETE')
            <div class="mt-4 button_delete">
                <button class="">Excluir</button>
            </div>
        </form>
    @else
        <h1>Usuário não encontrado, por favor, volte.</h1>
    @endif
<x-footer />