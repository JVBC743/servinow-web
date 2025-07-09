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
                <!-- Outras opções -->
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
                <li class="nav-item">
                    <a class="nav-link fs-5 {{ request()->routeIs('termos') ? 'active' : '' }}"
                        href="{{ route('termos') }}">
                        Uso e Privacidade
                    </a>
                </li>

                <!-- Dropdown Serviços -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5
                        {{ request()->routeIs('historico.agendamento.cliente', 'historico.agendamento.prestador') ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Serviços
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('historico.agendamento.cliente') ? 'active' : '' }}"
                                href="{{ route('servico.create') }}">
                                Cadastrar Serviço
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('historico.agendamento.cliente') ? 'active' : '' }}"
                                href="{{ route('agendamento.cliente') }}">
                                Serviços Recebidos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('historico.agendamento.prestador') ? 'active' : '' }}"
                                href="{{ route('servicos.cadastrados') }}">
                                Serviços Cadastrados
                            </a>
                        </li>
                        
                    </ul>
                </li>
                @auth
                    @if(auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link fs-5 {{ request()->routeIs('admin.lista.usuarios') ? 'active' : '' }}"
                                href="{{ route('admin.lista.usuarios') }}">
                                Lista de Usuários
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>            
            <!-- Ícone do usuário com dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown nav-icon">
                    <a class="nav-link dropdown-toggle
                        {{ request()->routeIs('visualizacao-perfil', 'mostrar.edicao', 'logout') ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('visualizacao-perfil') ? 'active' : '' }}"
                                href="{{ route('visualizacao-perfil') }}">
                                Perfil
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('mostrar.edicao') ? 'active' : '' }}"
                                href="{{ route('mostrar.edicao', ['id' => auth()->id()]) }}">
                                Editar Perfil
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
