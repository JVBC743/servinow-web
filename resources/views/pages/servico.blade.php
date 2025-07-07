@extends('layouts.autenticado')

@section('title', 'ServiNow - Agendar Serviço')

@section('content')
            <div class="row shadow mt-5" style="height: 100%; min-height: 700px">
                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                    <div class="text-center margin_div_servico">
                        <div>
                            <img src="{{ asset('images/logo-dark.png') }}" alt="Foto do serviço" class="" style="width: 300px; height: 100px">
                        </div>

                        
                        <label for="data" class="form-label fw-bold">Selecione a Data:</label>
                        <input type="date" id="data" name="data" class="form-control mb-5 text-cente" style="">

                        <button class="btn btn-info text-white px-4 my-5">Agendar</button>
                    </div>
                </div>

                <div class="col-12 col-md-4 text-center p-5 margin_div_servico">
                    <h4 class="fw-bold mt-3">Descrição do serviço:</h4>
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit amet porta eros.
                        Cras porttitor nulla in cursus accumsan. Cras id imperdiet odio, a ultrices felis. 
                        Quisque a tellus sed massa vulputate viverra vel aliquet risus. Donec tristique metus
                        nulla, eu ultrices neque mollis et. Phasellus ullamcorper laoreet tempus. 
                        Fusce elementum nunc nec arcu tempus, quis auctor odio laoreet.
                    </p>
                </div>

                <div class="col-12 col-md-4 margin_div_servico d-flex justify-content-center align-items-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <div class="img_div">
                                <img src="{{ asset('images/user-icon.png') }}" alt="Prestador" class=" mb-2">
                            </div>
                        </div>
                        
                        <h3 class="fw-bold text-center my-4">Nome do prestador</h3>
                        <div class=" px-5 mx-5">
                            <p class="text-center">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
@endsection