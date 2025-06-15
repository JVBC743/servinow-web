<x-header :title="'Cadastar Serviço'" />

    <h1 class="text-center emphasis_text my-3">Cadastrar serviço</h1>
    <div>
        <form action="{{ route('cadastro.servico.store') }}" method="post">



            <div class="mx-5 mb-5">

                <div class="inputs">
                    <input class="mt-5 mb-3" type="text" name="nome_servico" placeholder="Insira o título do servico">
                </div>


                <div class="d-flex mt-3">
                    <div class="me-5">
                        <input alt="Enviar imagem"type="image" class = "img_input" style="width: 150px; height: 30px">
                    </div>
                    <div class="">
                        <select name="" id="">
                            <option value="">Escolha a categoria</option>
                            {{-- @foreach ( as )
                                
                            @endforeach --}}
                        </select>
                    </div>
                </div>


            </div>
        </form>


    </div>


<x-footer />