<!-- Modal Denunciar Usuário (teste) -->
<div class="modal fade" id="modalDenunciarUsuarioTeste" tabindex="-1" aria-labelledby="modalDenunciarUsuarioLabelTeste" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-denunciar-usuario">
            <div class="modal-header modal-denunciar-header">
                <h3 class="modal-title modal-denunciar-title w-100 text-center" id="modalDenunciarUsuarioLabelTeste">Denunciar Usuário</h3>
                <button type="button" class="btn-close modal-denunciar-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('denunciar.prestador', $usr->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_prestador" value="{{ $usr->id }}">

                    <div class="card-denunciar-usuario mb-4">
                        <div class="card-body">
                            <div class="row-denunciar-usuario">
                                <div class="col-denunciar-usuario-esq">

                                    <div class="form-group-denunciar-usuario mb-3">
                                        <label for="titulo" class="label-denunciar-usuario">Titulo da denúncia<span class="required">*</span></label>
                                        <input type="text" name="titulo" class="form-control input-denunciar-usuario">
                                    </div>
                                    <!-- Motivo -->
                                    <div class="form-group-denunciar-usuario mb-3">
                                        <label for="motivoTeste" class="label-denunciar-usuario">Motivo<span class="required">*</span></label>
                                        <select name="motivo" id="motivoTeste" class="form-select select-denunciar-usuario" required>
                                            <option value="">Selecione o motivo</option>
                                            @foreach($motivos as $item)

                                                <option value="{{ $item->id }}"> {{ $item->motivo ? $item->motivo : '' }} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Evidência -->
                                    <div class="form-group-denunciar-usuario mb-3">
                                        <label for="anexoTeste" class="label-denunciar-usuario">Anexar evidências (opcional)</label>
                                        <input type="file" name="anexo" id="anexoTeste" class="form-control input-denunciar-usuario" accept="image/*,application/pdf">
                                        <small class="text-muted">Você pode anexar imagens ou PDF como evidência.</small>
                                    </div>
                                </div>
                                <div class="col-denunciar-usuario-dir">
                                    <!-- Descrição -->
                                    <div class="form-group-denunciar-usuario mb-3 h-100 d-flex flex-column">
                                        <label for="descricaoDenunciaTeste" class="label-denunciar-usuario">Descrição detalhada<span class="required">*</span></label>
                                        <textarea name="descricao" id="descricaoDenunciaTeste" class="form-control input-denunciar-usuario flex-grow-1" rows="7" maxlength="500" required placeholder="Descreva o ocorrido com detalhes"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-branco" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger btn-vermelho">Enviar denúncia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>