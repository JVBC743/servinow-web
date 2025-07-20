@extends('layouts.autenticado')

@section('title', 'Agendamentos')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-5 container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 1200px">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="flex-grow-1 text-center m-0">Seus serviços cadastrados</h1>

                <a href="{{ route('relatorio.servicos.pdf') }}" class="btn btn-primary">
                    Gerar Relatório
                </a>
            </div>

            <div class="table-responsive table-scroll-vertical">

                <table class="table table-bordered text-center align-middle">
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
                                <td>{{ $item->created_at->format('d/m/Y') }} às {{ $item->created_at->format('H:i') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-3">
                                        <!-- Botão para abrir a modal de editar serviço, passando o serviço correto -->
                                        <button type="button"
                                            class="bg-transparent border-0 p-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editarServicoModal{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square edit-icon"></i>
                                        </button>

                                        <button class="delete_icon_button bg-transparent border-0 p-0" data-bs-toggle="modal"
                                            data-bs-target="#modalConfirmDelete" data-servico-id="{{ $item->id }}">
                                                <i class="fa-solid fa-trash del-icon"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Editar Serviço para cada serviço -->
                            @include('components.modal-editar-servico', ['servico' => $item, 'categorias' => $categorias])
                        @endforeach
                    </tbody>

                </table>
                <small class="d-md-none text-muted">Deslize para o lado para ver mais →</small>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" id="form-delete-servico">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteLabel">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir este serviço?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
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
@endsection