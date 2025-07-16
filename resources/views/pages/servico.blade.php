@extends('layouts.autenticado')

@section('title', 'Agendar Serviço')

@section('content')
    {{-- {{ dd($servico->caminho_foto) }} --}}

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

    <div class="row shadow mt-3 mb-5 me-5" style="height: 100%; min-height: 700px;">

        <div class="d-flex justify-content-center align-items-center text-center" style="height: 150px">
            <h1 class=""> {{ $servico->nome_servico }} </h1>
        </div>

        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
            <div class="text-center">

                @if($servico->caminho_foto)
                    <div>
                        <img class="service_photo" src="{{ asset("$servico->caminho_foto") }}" alt="Foto do serviço">
                        <!-- TIRAR O ASSET PARA PUXAR O CAMIHNO DO MINIO
                                  A CONSULTA NO BANCO TÁ CERTA -->
                    </div>
                @else
                    <div>
                        <img class="service_photo" src="{{ asset('images/servico-nulo.png') }}" alt="Não há foto de serviço">
                    </div>
                @endif

                <button style="width: 200px; height: 50px" class="btn btn-info btn-geral text-white px-4 my-3" data-bs-toggle="modal" data-bs-target="#modalAgendamento">
                    Agendar
                </button>
            </div>
        </div>

        <div class="col-12 col-md-4 text-center p-5 margin_div_servico">
            <h4 class="fw-bold mt-3">Descrição do serviço:</h4>
            <p class="text-justify">
                {{ $servico->desc_servico }}
            </p>
        </div>

        <div class="col-12 col-md-4 margin_div_servico d-flex justify-content-center align-items-center">
            <div>
                <a href="{{ route('show.perfil.prestador', $servico->usuario_id) }}">
                    <!-- LINK PARA O PERFIL DO PRESTADOR -->

                    <div class="d-flex justify-content-center">
                        <div class="img_div">
                            <img src="{{ asset('images/user-icon.png') }}" alt="Prestador" class="mb-2">
                        </div>
                    </div>
                </a>

                <h3 class="fw-bold text-center my-4"> {{ $servico->prestador->nome }} </h3>
                <div class=" px-5 mx-5">
                    <p class="text-center">
                        {{ $servico->prestador->descricao }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- AGENDAMENTO --}}
    <div class="modal fade" id="modalAgendamento" tabindex="-1" aria-labelledby="modalAgendamentoabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('agendar') }}">
                    @csrf
                    <input type="hidden" name="id_servico" value="{{ $servico->id }}">
                    

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAvaliacaoLabel">Novo Agendamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="data" class="form-label">Selecione a data</label>
                            <input maxlength="10" type="text" class="form-control" name="data" id="data" placeholder="dd/mm/aaaa">
                            <script>
                                const dataInput = document.getElementById('data');
                                dataInput.addEventListener('input', function (e) {
                                    let value = e.target.value.replace(/\D/g, '');
                                    if (value.length > 2) value = value.replace(/(\d{2})(\d)/, '$1/$2');
                                    if (value.length > 5) value = value.replace(/(\d{2})\/(\d{2})(\d)/, '$1/$2/$3');
                                    e.target.value = value;
                                });
                            </script>
                        </div>
                        <div class="mb-3">
                            <div>
                                <label for="descricao">Insira uma descrição</label>
                            </div>
                            <div class="d-flex justify-content-center" style="width: 450px">
                                <textarea class="w-full" style="width: 450px" name="descricao" id="" placeholder="Insira aqui a sua descrição"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enviar solicitação</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- AVALIACAO --}}
    <h1 class="text-center">Avaliações</h1>
    <button class="mb-3 btn btn-info btn-geral text-white" data-bs-toggle="modal" data-bs-target="#modalAvaliacao">
        Enviar avaliação
    </button>

    <div class="modal fade" id="modalAvaliacao" tabindex="-1" aria-labelledby="modalAvaliacaoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('registrar.avaliacao') }}">
                    @csrf
                    <input type="hidden" name="id_servico" value="{{ $servico->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAvaliacaoLabel">Nova Avaliação</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nota" class="form-label">Titulo</label>
                            <input minlength="10" maxlength="25" class="form-control" type="text" name="titulo" placeholder="Insira o título da sua avaliacao" required>
                        </div>

                        <div class="mb-3">
                            <label for="nota" class="form-label">Quantas estrelas?</label>
                            <select name="nota" id="nota" class="form-select" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">
                                        {{ str_repeat('★', $i) . str_repeat('☆', 5 - $i) }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentário</label>
                            <textarea minlength="20" maxlength="50" name="comentario" id="comentario" class="form-control"
                            placeholder="Comentário com, no mínimo, 20 letras e com no máximo 50 letras." rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Avaliar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-2 ml-1 mr-1 mb-1">
        <div class="d-flex flex-wrap justify-content-center div-avaliacoes">
            @if ($avaliacoes->isNotEmpty())
                @foreach ($avaliacoes as $avaliacao)
                    <x-card-avaliacao 
                        profileImage="{{ $avaliacao->cliente->caminho_img ?? asset('images/user-icon.png') }}"

                        title="{{ $avaliacao->titulo }}"
                        userName="{{ $avaliacao->cliente->nome ?? 'Anônimo' }}"
                        rating="{{ $avaliacao->nota }}"
                        description="{{ $avaliacao->comentario }}"
                    />
                @endforeach
            @else
                <h1>Não há avaliações para esse serviço.</h1>
            @endif
        </div>
    </div>
@endsection