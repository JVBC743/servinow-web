@extends ('layouts.autenticado')
@section('title', 'Dashboard')
@section('content')


    <div class="row g-2 align-items-center">
        <div class="col-12 col-md-auto">
            <h1 class="m-0 fs-2 text-center text-md-start">Serviços Disponíveis</h1>
        </div>
        <div class="col-12 col-md">
            <x-search-bar :action="route('dashboard')" :search="$pesquisa ?? ''" :categorias="$categorias" />
        </div>
    </div>


    <hr>

    <div class="d-flex flex-wrap justify-content-center" style="gap: 20px;">

        <x-card-servico />
        <x-card-servico />
        <x-card-servico />
        <x-card-servico />
        <x-card-servico />
        <x-card-servico />
        <x-card-servico />
        <x-card-servico />


        @foreach($servicos as $item)
            <x-card-servico
                imageUrl="https://static.wixstatic.com/media/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg/v1/fill/w_740,h_493,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg"
                title="{{ $item->nome_servico }}" category="{{ $item->categoriaR->nome ?? 'Sem categoria' }}"
                description="{{ $item->desc_servico }}" buttonUrl="{{ route('servico', ['id' => $item->id]) }}" />
        @endforeach

    </div>


@endsection