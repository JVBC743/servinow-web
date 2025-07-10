@extends ('layouts.autenticado')
@section('title', 'Lista de Serviços')
@section('content')

    <div>
        <h3 class="txt-center" style="margin: 15px 0px">
            <b>Lista de Avaliação de Serviços</b>
        </h3>
    </div>
    <br>
    <div class="container-fluid" style="width: 95vw;">
        <div class="row">
            <div class="col-4 both-align">
                <br>
                <b class="fs-4">Avaliações</b>
                <div>
                    [Colocar as estrelas aki]
                    <br>
                    ★★★★☆
                </div>
                <div>
                    [Colocar a quant. de avaliações aki]
                    <br>
                    <i>
                        27 Avaliações
                    </i>
                </div>
                <br>

                <b class="fs-6">Avalie este produto</b>
                <p>Compartilhe seu pensamento com outros clientes.</p>

                <div class="h-align" style="display: flex;">
                    <button type="button" class="btn-avaliacao" onclick="alert('Em breve: modal de avaliação!')">
                        Escreva uma Avaliação
                </div>

            </div>
            <div class="col-8">
                <h5 class="txt-center">
                    <b>Principais avaliações de Serviços</b>
                </h5>
                    <div class="d-flex flex-wrap justify-content-center" style="gap: 20px;">

                    <!-- EXEMPLO DE COMPONENTE, FALTA ADICIONAR GRID DE DUAS COLUNAS COM OVERLOW Y  -->
                    <x-card-avaliacao profileImage="{{ asset('images/claion.png') }}" title="Me dá licença" userName="José"
                        rating="5" description="Preciso rever minhas amizades." />

                    <x-card-avaliacao profileImage="{{ asset('images/claion.png') }}" title="Me dá licença" userName="José"
                        rating="5" description="Preciso rever minhas amizades." />

                    <x-card-avaliacao profileImage="{{ asset('images/claion.png') }}" title="Me dá licença" userName="José"
                        rating="5" description="Preciso rever minhas amizades." />



            <x-card-avaliacao 
                profileImage="images/claion.png"
                userName="José"
                rating="5"
                description="Excelente profissional, pontual e muito educado!"
            />

                </div>
            </div>
        </div>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection