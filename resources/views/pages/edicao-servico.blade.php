<x-header :title="'Editar Serviço'" />
    <h1 class="text-center emphasis_text my-3">Editar serviço</h1>
    <div>
        <form action="" method="post">
            <div class="mx-5 mb-5">
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="">
                        <div class="inputs">
                            <input class="mt-5 mb-3" type="text" name="nome_servico" placeholder="The Bengas">
                        </div>
                        <div>

                            
                            <div class="d-flex mt-3 div_input_edit_service">
                                <div id = "img_input_edit_service" class="me-5">
                                    <input alt="Enviar imagem"type="image" class = "img_input" style="width: 150px; height: 30px">
                                </div>
                                <div id = "select_input_edit_serive" class="">
                                    <select name="" id="">
                                        <option value="">Escolha a categoria</option>
                                        {{-- @foreach ( as )
                                            
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>


                            <div class="my-4 big_input">
                                <input class ="" type="text" name="descricao_servico" id="" placeholder="Insira a descrição do serviço aqui mesmo">
                            </div>
                            <div class="d-flex justify-content-between div_buttons">
                                <div class="button_undo mx-5">
                                    <input type="button" value="Desfazer" class="">
                                </div>
                                <div class="button_delete mx-5 justify-content-end">
                                    <input type="button" value="Excluir" class="">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class = "justify-content-end mt-5">
                        <div class="ms-5 d-flex">
                            <div class="text-center fs-5">
                                <div class="">{{-- procurar saber como referenciar o caminho minio --}}
                                    <img src="" alt="Foto do usuário na tela de edição de perfil." class="profile_image">
                                </div>
                                <div class="mb-3">
                                </div>
                                <div class="photo_name fs-3 m">
                                    {{ $nome_foto = "teste" }} PROCURAR CAMINHO AQUI
                                </div>
                                <div class="mt-5">
                                </div>
                                <div class="mt-5">
                                </div>
                                <div class="mt-5">
                                    <input type="submit" value="Salvar" class="btn btn-primary button_save">
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>


<x-footer />