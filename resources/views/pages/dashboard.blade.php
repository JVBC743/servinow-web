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
                :imageUrl="$item->url_foto"
                title="{{ $item->nome_servico }}" category="{{ $item->categoriaR->nome ?? 'Sem categoria' }}"
                description="{{ $item->desc_servico }}" buttonUrl="{{ route('servico', ['id' => $item->id]) }}" />
        @endforeach

    </div>


@endsection
