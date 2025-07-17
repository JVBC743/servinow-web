@extends('layouts.nao-autenticado')

@section('title', 'Dashboard')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/card-servico.css') }}">
@endsection
@section('content')
    <div class="container-fluid">

        <div class="text-center my-5">
            <h2 class="mb-4">Bem-vindo ao ServiNow!</h2>
            <p class="mb-4">
                Cadastre-se ou faça login para visualizar e agendar serviços disponíveis na sua região.
            </p>
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Entrar</a>
            <a href="{{ route('cadastro.form') }}" class="btn btn-outline-primary">Cadastrar-se</a>
        </div>

        <hr>

        <h3 class="text-center my-4">Alguns dos nossos serviços:</h3>
        <div class="d-flex flex-wrap justify-content-center" style="gap: 20px;">
            @foreach ($servicos as $item)
                <x-card-servico
                    :imageUrl="$item->url_foto"
                    title="{{ $item->nome_servico }}"
                    category="{{ $item->categoriaR->nome ?? 'Sem categoria' }}"
                    description="{{ $item->desc_servico }}"
                    buttonUrl="{{ route('login') }}" />
            @endforeach
        </div>
    </div>

@endsection
