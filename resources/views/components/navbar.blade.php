<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}"> 
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sizes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">

</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="ServiNow-Logo.png" alt="Logo" class="navbar-logo">
            </a>
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{ route('dashboard') }}">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{ route('sobre.nos') }}">Sobre nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{ route('lista.servicos') }}">Meus Serviços</a>
                    </li>
                    {{-- CONSIDERAR USUÁRIO ADMINISTRADOR --}}
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="{{ route('lista.usuarios') }}">Sobre nós</a>
                    </li>
                    {{-- CONSIDERAR USUÁRIO ADMINISTRADOR --}}
                </ul>
    
                <!-- Icons -->
                <div class="d-flex align-items-center">
                    <a href="#" class="nav-link text-white fs-5 me-3">
                        <i class="fa-solid fa-bell"></i>
                    </a>
                    <a href="#" class="nav-link text-white fs-5">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>