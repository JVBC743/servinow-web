@extends('layouts.autenticado')
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

        @foreach($servicos as $item)
            <x-card-servico
            :imageUrl="$item->url_foto"
            title="{{ $item->nome_servico }}"
            category="{{ $item->categoriaR->nome ?? 'Sem categoria' }}"
            description="{{ $item->desc_servico }}"
            buttonUrl="{{ route('servico', ['id' => $item->id]) }}"
            price="{{ 'R$ ' . $item->preco }}"/>
        @endforeach
    </div>
@endsection
