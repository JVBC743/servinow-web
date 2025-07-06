<x-header :title="'Cadastar Serviço'" />

    <h1 class="text-center emphasis_text my-3">Cadastrar serviço</h1>
    <div class="">
        <form action="{{ route('cadastro.servico.create') }}" method="post">
            <div class="mx-5 mb-5">
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="">
                        <div class="inputs">
                            <input class="mt-5 mb-3" type="text" name="nome" placeholder="Insira o título do servico" maxlength="40" minlength="20" required>
                        </div>
                        <div>
                            <div class="d-flex mt-3">
                                <div class="me-5">
                                    <input name = "imagem" alt="Enviar imagem"type="image" class = "img_input" style="width: 150px; height: 30px" required >
                                </div>
                                <div class="">
                                    <select name="categoria" id="">
                                        <option value="">Escolha a categoria</option>
                                        {{-- @foreach ( as )
                                            
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 big_input">
                            <textarea maxlength="750" class ="inputs_desc" type="text" name="descricao" id="" placeholder="Insira a descrição do serviço aqui mesmo" required maxlength="750"></textarea>
                        </div>
                    </div>
                    
                    <div class = "justify-content-end mt-5">
                        <div class="ms-5 d-flex">
                            <div class="text-center fs-5">
                                <div class="">{{-- procurar saber como referenciar o caminho minio --}}
                                    <img src="" alt="Foto do usuário na tela de edição de perfil." class="profile_image" required>
                                </div>
                                <div class="mb-3">

                                </div>
                                <div class="photo_name fs-3">
                                    {{ $nome_foto = "teste" }} PROCURAR CAMINHO AQUI
                                </div>
                                <div class="mt-4 button_save">
                                    <input type="submit" value="Salvar" class="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>

<x-footer />