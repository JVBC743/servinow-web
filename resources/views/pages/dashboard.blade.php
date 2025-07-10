@extends ('layouts.autenticado')
@section('title', 'Dashboard')
@section('content')


    <div class="d-flex align-items-center justify-content-between gap-2">
        <h1 class="m-0">Serviços Disponíveis</h1>
        <div class="flex-grow-1 ms-3" style="max-width: 400px;">
            <x-search-bar 
                action="{{ route('dashboard') }}" :search="$pesquisa ?? ''"
            />
        </div>
    </div>

    <hr>

    <div class="d-flex flex-wrap justify-content-center" style="gap: 20px;">
        @foreach($servicos as $item)
            <x-card-servico
                imageUrl="https://static.wixstatic.com/media/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg/v1/fill/w_740,h_493,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg"
                title='{{ $item->nome_servico }}' 
                description=" {{ $item->desc_servico }} "
                buttonUrl=" {{ route('servico', ['id' => $item->id]) }}"
                />
        @endforeach
    </div>

    <x-card-avaliacao 
    profileImage="{{ asset('images/claion.png') }}"
    title="Me dá licença"
    userName="José"
    rating="5"
    description="Preciso rever minhas amizades."
    />

@endsection