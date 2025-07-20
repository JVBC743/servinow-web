<!-- Modal Editar Serviço para cada serviço -->
<div class="modal fade" id="editarServicoModal{{ $servico->id }}" tabindex="-1" aria-labelledby="editarServicoModalLabel{{ $servico->id }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-editar-perfil">
            <div class="modal-header modal-editar-header">
                <h3 class="modal-title modal-editar-title w-100 text-center" id="editarServicoModalLabel{{ $servico->id }}">Editar Serviço</h3>
                <button type="button" class="btn-close modal-editar-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                @if($servico)
                <form action="{{ route('servico.update', $servico->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-editar-perfil mb-4">
                        <div class="card-body">
                            <h5 class="card-title card-editar-title">Dados do Serviço</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Título do Serviço -->
                                    <div class="form-group-editar-perfil mb-3">
                                        <label for="nome_servico{{ $servico->id }}" class="label-editar-perfil">Título do Serviço<span class="required">*</span></label>
                                        <input type="text" name="nome" id="nome_servico{{ $servico->id }}" class="form-control input-editar-perfil"
                                            placeholder="Insira o título do serviço" value="{{ old('nome', $servico->nome_servico) }}"
                                            minlength="20" maxlength="40" required>
                                    </div>
                                    <!-- Categoria -->
                                    <div class="form-group-editar-perfil mb-3">
                                        <label for="categoria{{ $servico->id }}" class="label-editar-perfil">Categoria<span class="required">*</span></label>
                                        <select name="categoria" id="categoria{{ $servico->id }}" class="form-select select-editar-perfil" required>
                                            <option value="">Escolha a categoria</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}"
                                                    {{ old('categoria', $servico->categoria) == $categoria->id ? 'selected' : '' }}>
                                                    {{ $categoria->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Descrição -->
                                    <div class="form-group-editar-perfil mb-3 h-100 d-flex flex-column">
                                        <label for="descricao{{ $servico->id }}" class="label-editar-perfil">Descrição<span class="required">*</span></label>
                                        <textarea name="descricao" id="descricao{{ $servico->id }}" class="form-control input-editar-perfil flex-grow-1" rows="7"
                                            placeholder="Insira a descrição do serviço aqui mesmo" maxlength="750" required>{{ old('descricao', $servico->desc_servico) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Imagem do Serviço (embaixo de tudo) -->
                            <div class="form-group-editar-perfil mb-3 mt-4">
                                <label for="imagem{{ $servico->id }}" class="label-editar-perfil">Alterar Imagem do Serviço</label>
                                <input type="file" name="imagem" id="imagem{{ $servico->id }}" class="form-control input-editar-perfil" accept="image/*">
                                @if (!empty($servico->imagem_url))
                                    <div class="mt-3 text-center">
                                        <p>Imagem atual:</p>
                                        <img src="{{ $servico->imagem_url }}" alt="Imagem do Serviço" class="img-fluid mx-auto d-block" style="max-height: 200px;">
                                    </div>
                                @else
                                    <div class="mt-3 text-center">
                                        <p>Não há imagem</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-branco" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-verde">Salvar alterações</button>
                    </div>
                </form>
                @else
                    <h3 class="text-center text-danger">Serviço não encontrado, por favor, volte.</h3>
                @endif
            </div>
        </div>
    </div>
</div>