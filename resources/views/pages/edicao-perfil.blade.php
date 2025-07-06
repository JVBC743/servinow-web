
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
    {{-- @if ($error)
    <h1>{{ $error }}</h1>
    @endif --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.usuario.edit', $editarUsuario->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="d-flex flex-wrap justify-content-between">
                <div class="d-flex fs-5 flex-wrap me-5">
                    <div class="my-3 mx-5 inputs">

                        <input class = "mb-3" type="text" placeholder="Nome" name="nome" value="{{ $editarUsuario->nome ?? '' }}" required maxlength="50"><br>
                        <input class = "mb-3" type="email" placeholder="E-mail" name="email" value="{{ $editarUsuario->email ?? '' }}" required maxlength="80"><br>
                        <input class = "mb-3" type="text" placeholder="Telefone" name="telefone" value="{{ $editarUsuario->telefone ?? '' }}" required maxlength="15"><br>
                        {{-- <input class = "mb-3" type="text" placeholder="Área de atuação" name="area_atuacao" value="{{ $editarUsuario->nome_atuacao ?? '' }}"><br> --}}
                        
                        <p style="font-size: 15px">Anexar imagem</p>
                        <div class="d-flex justify-content-between flex-wrap align-items-start">
                            <div>
                                <input name="foto" alt="Enviar imagem" type="file" class = "img_input" style="width: 150px; height: 50px">
                            </div>
                            <select class="select" name="area_atuacao" required>

                                <option value="">Selecione a sua formação</option>

                                @foreach ($lista as $formacoes)
                                    <option value="{{ $formacoes->id }}" {{ $editarUsuario->area_atuacao == $formacoes->id ? 'selected' : '' }}>
                                        {{ $formacoes->formacao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <textarea name="descricao" class="my-3 inputs_desc" placeholder="Adicione aqui uma breve descrição das suas competências, seu limite é de 300 caracteres" maxlength="300">{{ old('descricao', $editarUsuario->descricao) }}</textarea>
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
                        @if($editarUsuario->caminho_img)

                            <div class="">{{-- procurar saber como referenciar o caminho minio --}}
                                <img src="{{ $editarUsuario->imagem_bucket }}" alt="Foto do usuário na tela de edição de perfil." class="profile_img">
                            </div>
                        @else

                            <div class="">
                                <img src=" {{ asset('images/user-icon.png') }} " alt="Foto do usuário na tela de edição de perfil." class="profile_img">
                            </div>

                        @endif

                        <div class="mb-3"></div>                       
                        <div class="mt-4 button_save">
                            <input type="submit" value="Salvar" class="">
                        </div>
                    </div><br>
                </div>
            </div>
        </form>
        {{-- <form action="" method="post">
            @csrf
            @method('DELETE')
            <div class="mt-4 button_delete">
                <button class="">Excluir</button>
            </div>
        </form> --}}
    @else
        <h1>Usuário não encontrado, por favor, volte.</h1>
    @endif
<x-footer />