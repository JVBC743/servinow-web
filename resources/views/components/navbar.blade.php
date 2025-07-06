<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo-dark.png') }}" alt="Logo" class="navbar-logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fs-5 {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 {{ request()->routeIs('sobre.nos') ? 'active' : '' }}"
                        href="{{ route('sobre.nos') }}">
                        Sobre nós
                    </a>
                </li>
            </ul>

            <!-- Icons -->
            <div class="d-flex align-items-center nav-icon">
                <a href="#" class="nav-link text-white fs-5 me-3">
                    <i class="fa-solid fa-bell"></i>
                </a>
                <a href="{{ route('visualizacao-perfil') }}"
                    class="nav-link text-white fs-5 {{ request()->routeIs('visualizacao-perfil') ? 'active' : '' }}">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
