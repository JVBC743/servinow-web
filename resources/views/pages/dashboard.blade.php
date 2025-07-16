@extends ('layouts.autenticado')
@section('title', 'Dashboard')
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

    <div class="d-flex align-items-center justify-content-between gap-2" style="max-width: 100%">
        <h1 class="m-0">Serviços Disponíveis</h1>
        <div class="flex-grow-1 ms-3" style="">
            <x-search-bar :action="route('dashboard')" :search="$pesquisa ?? ''" :categorias="$categorias" />
        </div>
    </div>

    <hr>

    <div class="d-flex flex-wrap justify-content-center" style="gap: 20px;">
        @foreach($servicos as $item)
            <x-card-servico
                imageUrl="https://static.wixstatic.com/media/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg/v1/fill/w_740,h_493,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/1233ff_ca96ec225309492dbd2cef0b7ca9938f~mv2.jpg"
                title="{{ $item->nome_servico }}" category="{{ $item->categoria->nome ?? 'Sem categoria' }}"
                description="{{ $item->desc_servico }}" buttonUrl="{{ route('servico', ['id' => $item->id]) }}" />
        @endforeach

    </div>


@endsection