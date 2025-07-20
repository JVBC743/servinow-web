<!-- Modal -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true"
    data-bs-backdrop="static" style="z-index: 10000;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-editar-perfil">
            <div class="modal-header modal-editar-header">
                <h3 class="modal-title modal-editar-title w-100 text-center" id="editarPerfilModalLabel">Editar Perfil</h3>
                <button type="button" class="btn-close modal-editar-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                @if($usr)
                <form action="{{ route('editar.usuario', $usr->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Informações Pessoais e Formação / Área de Atuação -->
                    <div class="row-editar-perfil">
                        <div class="card-editar-perfil">
                            <div class="card-body">
                                <h5 class="card-title card-editar-title">Informações Pessoais</h5>
                                <div class="form-group-editar-perfil">
                                    <label for="nome" class="label-editar-perfil">Nome<span class="required">*</span></label>
                                    <input type="text" name="nome" id="nome" class="form-control input-editar-perfil " value="{{ old('nome', $usr->nome) }}" maxlength="50" required>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3 form-group-editar-perfil">
                                        <label for="email" class="label-editar-perfil">E-mail<span class="required">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control input-editar-perfil " value="{{ old('email', $usr->email) }}" maxlength="80" required>
                                    </div>
                                    <div class="col-md-6 mb-3 form-group-editar-perfil">
                                        <label for="telefone" class="label-editar-perfil">Telefone<span class="required">*</span></label>
                                        <input type="text" name="telefone" id="celular" class="form-control input-editar-perfil " value="{{ old('telefone', $usr->telefone) }}" maxlength="15" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-editar-perfil">
                            <div class="card-body">
                                <h5 class="card-title card-editar-title">Descrição profissional</h5>
                                <div class="form-group-editar-perfil">
                                    <label for="area_atuacao" class="label-editar-perfil">Área de Atuação<span class="required">*</span></label>
                                    <select name="area_atuacao" id="area_atuacao" class="form-select select-editar-perfil " required>
                                        <option value="">Selecione a sua formação</option>
                                        @foreach ($lista as $formacao)
                                            <option value="{{ $formacao->id }}"
                                                {{ (int) old('area_atuacao', $usr->area_atuacao) === $formacao->id ? 'selected' : '' }}>
                                                {{ $formacao->formacao }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3 form-group-editar-perfil">
                                        <label for="descricao" class="label-editar-perfil">Descrição (max 300 caracteres)</label>
                                        <textarea name="descricao" id="descricao" class="form-control input-editar-perfil " maxlength="300" rows="4" placeholder="Adicione uma breve descrição das suas competências">{{ old('descricao', $usr->descricao) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Endereço / Foto de Perfil -->
                    <div class="row-editar-perfil">
                        <div class="card-editar-perfil">
                            <div class="card-body">
                                <h5 class="card-title card-editar-title">Endereço</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3 form-group-editar-perfil">
                                        <label for="cep" class="label-editar-perfil">CEP<span class="required">*</span></label>
                                        <input type="text" name="cep" id="cep" class="form-control input-editar-perfil " maxlength="10" value="{{ old('cep', $usr->cep ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3 form-group-editar-perfil">
                                        <label for="logradouro" class="label-editar-perfil">Logradouro<span class="required">*</span></label>
                                        <input type="text" name="logradouro" id="logradouro" class="form-control input-editar-perfil " value="{{ old('logradouro', $usr->logradouro ?? '') }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3 form-group-editar-perfil">
                                        <label for="numero" class="label-editar-perfil">Número<span class="required">*</span></label>
                                        <input type="text" name="numero" id="numero" class="form-control input-editar-perfil " value="{{ old('numero', $usr->numero ?? '') }}" required>
                                    </div>
                                    <div class="col-md-8 mb-3 form-group-editar-perfil">
                                        <label for="complemento" class="label-editar-perfil">Complemento</label>
                                        <input type="text" name="complemento" id="complemento" class="form-control input-editar-perfil " value="{{ old('complemento', $usr->complemento ?? '') }}">
                                    </div>
                                    <div class="col-md-6 mb-3 form-group-editar-perfil">
                                        <label for="bairro" class="label-editar-perfil">Bairro<span class="required">*</span></label>
                                        <input type="text" name="bairro" id="bairro" class="form-control input-editar-perfil " value="{{ old('bairro', $usr->bairro ?? '') }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3 form-group-editar-perfil">
                                        <label for="cidade" class="label-editar-perfil">Cidade<span class="required">*</span></label>
                                        <input type="text" name="cidade" id="cidade" class="form-control input-editar-perfil " value="{{ old('cidade', $usr->cidade ?? '') }}" required>
                                    </div>
                                    <div class="col-md-2 mb-3 form-group-editar-perfil">
                                        <label for="uf" class="label-editar-perfil">UF<span class="required">*</span></label>
                                        <input type="text" name="uf" id="uf" maxlength="2" class="form-control input-editar-perfil " value="{{ old('uf', $usr->uf ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-editar-perfil">
                            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                                <h5 class="card-title card-editar-title">Foto de Perfil</h5>
                                @if($imagem_url)
                                    <img src="{{ $imagem_url }}" alt="Foto do usuário" class="profile_img-editar mb-3" style="width: 200px; border-radius: 50%;">
                                @else
                                    <img src="{{ asset('images/user-icon.png') }}" alt="Usuário sem foto" class="profile_img-editar mb-3" style="width: 200px; border-radius: 50%;">
                                @endif
                                <input type="file" name="foto" accept="image/*" class="form-control input-editar-perfil w-75 mx-auto ">
                                <small class="text-muted mt-1">Anexar nova imagem</small>
                            </div>
                        </div>
                    </div>

                    <!-- Ações -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-branco" onclick="window.location='{{ route('visualizacao.perfil') }}'">Fechar</button>
                        <button type="button" class="btn btn-danger btn-vermelho" data-bs-toggle="modal" data-bs-target="#modalExcluirConta">Excluir Conta</button>
                        <button type="submit" class="btn btn-primary btn-verde">Salvar alterações</button>
                    </div>
                </form>

                @else
                    <h3 class="text-center text-danger">Usuário não encontrado, por favor, volte.</h3>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação de exclusão (fora da modal principal) -->
<div class="modal fade" id="modalExcluirConta" tabindex="-1" aria-labelledby="modalExcluirContaabel" aria-hidden="true" style="z-index: 10000;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('excluir.usuario', $usr->id ) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalExcluirConta">Tem certeza?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>Caso você prossiga com essa ação, a sua conta, serviços, agendamentos, solicitações e avaliações serão excluídas do sistema.
                        E nenhum desses dados podem ser recuperados.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-branco px-5" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btn-vermelho px-5">Confirmar Exclusão</button>
                </div>
            </form>
        </div>
    </div>
</div>