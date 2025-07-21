@extends('layouts.autenticado')

@section('title', 'Agendamentos')

@section('content')
    <div class="d-flex flex-wrap gap-4 justify-content-center mb-3">
        <div class="card-resumo">
            <div class="titulo-card">Agendados como cliente</div>
            <div class="valor-card">{{ $agendamento_cliente->count() }}</div>
        </div>
        <div class="card-resumo">
            <div class="titulo-card">Agendados como prestador</div>
            <div class="valor-card">
                {{ $agendamento_prestador->count() }}
            </div>
        </div>
        <div class="card-resumo">
            <div class="titulo-card">Serviços solicitados</div>
            <div class="valor-card">
                {{ $agendamento->where('id_prestador', auth()->id())->where('status', 1)->count() }}
            </div>
        </div>
        <div class="card-resumo">
            <div class="titulo-card">Serviços cadastrados</div>
            <div class="valor-card">{{ $servicos->count() }}</div>
        </div>

    </div>
    <hr>
    <!-- Botões de collapse com versão detalhada -->
    <div class="row g-3 justify-content-center mb-5">
        <div class="col-12 col-sm-6 col-lg-3 d-flex">
            <x-btn variant="padrao-detalhado" class="flex-fill" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseCliente" aria-expanded="false" aria-controls="collapseCliente">
                <i class="fa-solid fa-user me-2"></i>
                <span>Agendados como Cliente</span>
            </x-btn>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 d-flex">
            <x-btn variant="padrao-detalhado" class="flex-fill" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsePrestador" aria-expanded="false" aria-controls="collapsePrestador">
                <i class="fa-solid fa-user-tie me-2"></i>
                <span>Agendados como Prestador</span>
            </x-btn>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 d-flex">
            <x-btn variant="padrao-detalhado" class="flex-fill" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseSolicitados" aria-expanded="false" aria-controls="collapseSolicitados">
                <i class="fa-solid fa-calendar-check me-2"></i>
                <span>Serviços Agendados</span>
            </x-btn>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 d-flex">
            <x-btn variant="padrao-detalhado" class="flex-fill" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseCadastrados" aria-expanded="false" aria-controls="collapseCadastrados">
                <i class="fa-solid fa-folder-open me-2"></i>
                <span>Serviços Cadastrados</span>
            </x-btn>
        </div>
    </div>
    <div id="collapseGroup">
        <!-- Serviços Agendados como Cliente -->
        <div class="collapse show" id="collapseCliente" data-bs-parent="#collapseGroup">
            <div class="card card-body" style="width: 100%;">
                <div class="card-table-container">
                    <h2 class="table-title text-center">Serviços Agendados como Cliente</h2>
                    <div class="table-responsive table-scroll-vertical">
                        <table class="table table-modern text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Prestador</th>
                                    <th>Serviço</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendamento_cliente as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->id_prestador ? $item->prestador->nome : 'Prestador inexistente.' }}</td>
                                        <td>{{ $item->id_servico ? $item->servico->nome_servico : 'Serviço inexistente.' }}</td>
                                        <td>{{ $item->prazo_formatado }}</td>
                                        <td>
                                            {{  $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                                    <i class="fa-solid fa-circle-info geral-icon"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Serviços Agendados como Prestador -->
        <div class="collapse" id="collapsePrestador" data-bs-parent="#collapseGroup">
            <div class="card card-body" style="width: 100%;">
                <div class="card-table-container">
                    <h2 class="table-title text-center">Serviços Agendados como Prestador</h2>
                    <div class="table-responsive table-scroll-vertical">
                        <table class="table table-modern text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Serviço</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendamento_prestador as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->id_cliente ? $item->cliente->nome : 'Cliente inexistente.' }}</td>
                                        <td>{{ $item->id_servico ? $item->servico->nome_servico : 'Serviço inexistente.' }}</td>
                                        <td>{{ $item->prazo_formatado }}</td>
                                        <td>{{ $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <i class="fa-solid fa-eye geral-icon" data-bs-toggle="modal"
                                                    data-bs-target="#modalEstado{{ $item->id }}"></i>
                                                <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                                    <i class="fa-solid fa-circle-info geral-icon"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <x-modal-default :id="'modalEstado' . $item->id" title="Status do Serviço">
                                        <div>
                                            <div class="form-group-editar-perfil mb-3">
                                                <label class="label-editar-perfil">Serviço</label>
                                                <input type="text" class="form-control input-editar-perfil"
                                                    value="{{ $item->servico->nome_servico ?? 'Serviço inexistente.' }}"
                                                    disabled>
                                            </div>
                                            <div class="form-group-editar-perfil mb-3">
                                                <label class="label-editar-perfil">Prazo</label>
                                                <input type="text" class="form-control input-editar-perfil"
                                                    value="{{ $item->prazo_formatado }}" disabled>
                                            </div>
                                            <div class="form-group-editar-perfil mb-0">
                                                <label class="label-editar-perfil">Descrição</label>
                                                <textarea class="form-control input-editar-perfil" rows="4"
                                                    disabled>{{ $item->descricao }}</textarea>
                                            </div>
                                        </div>
                                        <x-slot name="footer_left">
                                            @if($item->status == 2)
                                                <form class="form-finalizar-falha" action="{{ route('fechar.falha') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id_servico" value="{{ $item->id_servico}}">
                                                    <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                                    <x-btn variant="vermelho" type="submit" name="fechar_falha">
                                                        <i class="fa-solid fa-times me-2"></i>
                                                        Finalizado sem sucesso
                                                    </x-btn>
                                                </form>
                                            @endif
                                        </x-slot>
                                        <x-slot name="footer_right">
                                            @if($item->status == 2)
                                                <form class="form-finalizar-sucesso" action="{{ route('fechar.sucesso') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id_servico" value="{{ $item->id_servico}}">
                                                    <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                                    <x-btn variant="verde" type="submit" name="fechar_sucesso">
                                                        <i class="fa-solid fa-check me-2"></i>
                                                        Finalizado com sucesso
                                                    </x-btn>
                                                </form>
                                            @endif
                                        </x-slot>
                                    </x-modal-default>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Serviços Agendados (Solicitações) -->
        <div class="collapse" id="collapseSolicitados" data-bs-parent="#collapseGroup">
            <div class="card card-body" style="width: 100%;">
                <div class="card-table-container">
                    <h2 class="table-title text-center">Serviços Agendados</h2>
                    <div class="table-responsive table-scroll-vertical">
                        <table class="table table-modern text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Solicitante</th>
                                    <th>Serviço</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendamento as $item)
                                    @if($item->id_prestador == auth()->id() && $item->status == 1)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->id_cliente ? $item->cliente->nome : 'Cliente inexistente.' }}</td>
                                            <td>{{ $item->id_servico ? $item->servico->nome_servico : 'Serviço inexistente.' }}</td>
                                            <td>{{ $item->prazo_formatado }}</td>
                                            <td>{{ $item->status ? $item->statusAgendamento->status : 'Status desconhecido' }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <i class="fa-solid fa-eye eye-icon" data-bs-toggle="modal"
                                                        data-bs-target="#modalSolicitacao{{ $item->id }}"></i>
                                                    <a href="{{ route('servico', ['id' => $item->id_servico]) }}">
                                                        <i class="fa-solid fa-circle-info info-icon"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <x-modal-default :id="'modalSolicitacao' . $item->id" :title="'Nova Solicitação'">
                                            <div>
                                                <div class="form-group-editar-perfil mb-3">
                                                    <label class="label-editar-perfil">Solicitante</label>
                                                    <input type="text" class="form-control input-editar-perfil"
                                                        value="{{ $item->id_cliente ? $item->cliente->nome : 'Cliente inexistente.' }}"
                                                        disabled>
                                                </div>
                                                <div class="form-group-editar-perfil mb-3">
                                                    <label class="label-editar-perfil">Telefone para contato</label>
                                                    <input type="text" class="form-control input-editar-perfil"
                                                        value="{{ $item->id_cliente ? $item->cliente->telefone : 'Telefone inexistente' }}"
                                                        disabled>
                                                </div>
                                                <div class="form-group-editar-perfil mb-0">
                                                    <label class="label-editar-perfil">Descrição</label>
                                                    <textarea class="form-control input-editar-perfil" rows="4"
                                                        disabled>{{ $item->descricao }}</textarea>
                                                </div>
                                            </div>
                                            <x-slot name="footer_left">
                                                <form action="{{ route('negacao.solicitacao') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                                    <x-btn variant="vermelho" type="submit" name="negar">
                                                        Negar solicitação
                                                    </x-btn>
                                                </form>
                                            </x-slot>
                                            <x-slot name="footer_right">
                                                <form action="{{ route('aceitacao.solicitacao') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id_agendamento" value="{{ $item->id }}">
                                                    <x-btn variant="verde" type="submit" name="aceitar">
                                                        Aceitar solicitação
                                                    </x-btn>
                                                </form>
                                            </x-slot>
                                        </x-modal-default>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Serviços Cadastrados -->
        <div class="collapse" id="collapseCadastrados" data-bs-parent="#collapseGroup">
            <div class="card card-body" style="width: 100%;">
                <div class="card-table-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="table-title text-center mb-0">Serviços Cadastrados</h2>
                        <a href="{{ route('servico.create') }}">
                            <x-btn variant="verde" type="button">
                                <i class="fa-solid fa-plus me-2"></i>
                                Cadastrar Serviço
                            </x-btn>
                        </a>
                    </div>
                    <div class="table-responsive table-scroll-vertical">
                        <table class="table table-modern text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Serviço</th>
                                    <th>Criado em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicos as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nome_servico ?? 'Status não encontrado.' }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }} às {{ $item->created_at->format('H:i') }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-3">
                                                <button type="button" class="bg-transparent border-0 p-0" data-bs-toggle="modal"
                                                    data-bs-target="#editarServicoModal{{ $item->id }}">
                                                    <i class="fa-solid fa-pen-to-square edit-icon"></i>
                                                </button>
                                                <button class="delete_icon_button bg-transparent border-0 p-0"
                                                    data-bs-toggle="modal" data-bs-target="#modalConfirmDelete"
                                                    data-servico-id="{{ $item->id }}">
                                                    <i class="fa-solid fa-trash del-icon"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('components.modal-editar-servico', ['servico' => $item, 'categorias' => $categorias])
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal de Confirmação de Exclusão -->
                <div class="modal fade" id="modalConfirmDelete" tabindex="-1" aria-labelledby="modalDeleteLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="POST" id="form-delete-servico">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteLabel">Confirmar Exclusão</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza que deseja excluir este serviço?
                                </div>
                                <div class="modal-footer">
                                    <x-btn variant="branco" type="button" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-times me-2"></i>
                                        Cancelar
                                    </x-btn>
                                    <x-btn variant="vermelho" type="submit">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        Excluir
                                    </x-btn>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @push('scripts')
                    <script>
                        const modal = document.getElementById('modalConfirmDelete');
                        const form = document.getElementById('form-delete-servico');
                        modal.addEventListener('show.bs.modal', function (event) {
                            const button = event.relatedTarget;
                            const servicoId = button.getAttribute('data-servico-id');
                            const action = "{{ route('servico.destroy', ['servico' => '__id__']) }}".replace('__id__', servicoId);
                            form.setAttribute('action', action);
                        });
                    </script>
                @endpush
            </div>
        </div>
    </div>

@endsection