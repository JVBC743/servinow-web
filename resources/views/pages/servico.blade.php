@extends('layouts.autenticado')

@section('title', 'Agendar Serviço')

@section('content')
            <div class="row shadow mt-3 mb-5" style="height: 100%; min-height: 700px">

                <h1 class="text-center mt-5"> {{ $servico->nome_servico }} </h1>
                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                    <div class="text-center margin_div_servico">
                        <div>
                            <img src="https://static.wixstatic.com/media/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg/v1/fill/w_740,h_493,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg" alt="Foto do serviço" class="" style="width: 300px; height: 100px">
                        </div>
                        <div class="my-5">
                            <label for="data" class="form-label fw-bold">Selecione a Data:</label>
                            <input type="date" id="data" name="data" class="form-control text-cente" style="">
                        </div>

                        <button class="btn btn-info text-white px-4 my-3">Agendar</button>
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
                        <a href=" "> <!-- LINK PARA O PERFIL DO PRESTADOR -->
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
            <h1 class="text-center">Avaliações</h1>
            <button class="btn btn-info text-white">Enviar avaliação</button>
            {{-- MODAL AQUI --}}
            <div class="container-fluid">
                <div class="row justify-content-center shadow my-5">
                    <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-4 my-4 shadow rounded p-3 bg-white">

                        <!-- Título e Estrelas -->
                        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-2 mb-3">
                            <h3 class="m-0 text-center">Título da avaliação</h3>
                            <h3 class="m-0 text-center">X X X X X</h3>
                        </div>

                        <hr>

                        <!-- Avatar e Nome -->
                        <div class="d-flex align-items-center gap-3 px-2 mb-3">
                            <img src="https://static.wixstatic.com/media/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg/v1/fill/w_740,h_493,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg"
                                alt=""
                                style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
                            <span class="fw-semibold">{{ $cliente = "Nome de Teste" }}</span>
                        </div>

                        <hr>

                        <!-- Comentário alinhado à esquerda -->
                        <div class="px-2">
                            <p class="m-0">
                                Comentário da avaliação
                            </p>
                        </div>

                        <!-- Data alinhada à direita -->
                        <div class="text-end pe-2 mt-2">
                            <small class="text-muted">{{ $data = "XX/XX/XXXX" }}</small>
                        </div>

                    </div>
                </div>
            </div>


@endsection