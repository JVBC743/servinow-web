@extends('layouts.autenticado')

@section('title', 'Agendar Serviço')

@section('content')
                        {{-- {{ dd($servico->caminho_foto) }} --}}


            <div class="row shadow mt-3 mb-5 me-5" style="height: 100%; min-height: 700px;">

                <h1 class="text-center mt-5"> {{ $servico->nome_servico }} </h1>
                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                    <div class="text-center margin_div_servico">

                        @if($servico->caminho_foto)
                            <div>
                                <img class="service_photo" src="{{ asset("$servico->caminho_foto") }}" alt="Foto do serviço"> <!-- TIRAR O ASSET PARA PUXAR O CAMIHNO DO MINIO
                                                                                                                                        A CONSULTA NO BANCO TÁ CERTA -->
                            </div>
                        @else
                            <div>
                                <img class="service_photo" src="{{ asset('images/servico-nulo.png') }}" alt="Não há foto de serviço">
                            </div>

                        @endif


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

                <div class="col-12 col-md-4 margin_div_servico d-flex justify-content-center align-items-center mb-5">
                    <div>
                        <a href="{{ route('show.perfil.prestador', $servico->usuario_id) }}"> <!-- LINK PARA O PERFIL DO PRESTADOR -->

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
            <div class="container-fluid shadow mt-3 me-4">
                <div class="mt-4">
                    <x-card-avaliacao  
                        profileImage="{{ asset('images/claion.png') }}"
                        title="Me dá licença"
                        userName="José"
                        rating="5"
                        description="Preciso rever minhas amizades."
                    />
                </div>
                    

            </div>


@endsection