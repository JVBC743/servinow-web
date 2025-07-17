@extends('layouts.autenticado')

@section('title', 'Termos de Uso')

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

    <div class="container py-5">
        <h1 class="text-center mb-4">Termos de Uso e Política de Privacidade - ServiNow</h1>

        <div class="fs-5">
            <p><strong>1 - Objetivo</strong></p>
            <div class="ms-4 mb-4">
                O sistema ServiNow tem o objetivo de facilitar a conexão entre clientes e prestadores de serviço, por meio de funcionalidades como agendamento, avaliação e gerenciamento de serviços, acessíveis em diversos dispositivos.
            </div>

            <p><strong>2 - Funcionalidades</strong></p>
            <div class="ms-4 mb-4">
                <p>2.1 O sistema oferece as seguintes funcionalidades:</p>
                <ul>
                    <li>Cadastro e login de usuário;</li>
                    <li>Cadastro e gerenciamento de serviços;</li>
                    <li>Agendamento de serviços;</li>
                    <li>Avaliação de serviços prestados;</li>
                    <li>Canal de denúncias;</li>
                    <li>Configurações de conta;</li>
                    <li>Geração de relatórios e controle de histórico;</li>
                    <li>Busca por categorias e prestadores.</li>
                </ul>
            </div>

            <p><strong>3 - Responsabilidades do Usuário</strong></p>
            <div class="ms-4 mb-4">
                <p><strong>3.1 Conduta Geral</strong></p>
                <div class="ms-3 mb-3">
                    Ao utilizar o ServiNow, o usuário compromete-se a:
                    <ul>
                        <li>Agir de forma ética, respeitosa e conforme as leis brasileiras;</li>
                        <li>Fornecer informações verdadeiras e atualizadas;</li>
                        <li>Não praticar discriminação, discurso de ódio ou assédio;</li>
                        <li>Respeitar os limites técnicos e operacionais da plataforma.</li>
                    </ul>
                </div>

                <p><strong>3.2 Proibições</strong></p>
                <div class="ms-3 mb-3">
                    É expressamente proibido:
                    <ul>
                        <li>Propor, anunciar ou solicitar serviços de natureza sexual, prostituição ou semelhantes;</li>
                        <li>Anunciar, vender ou divulgar produtos ilegais ou sem autorização legal;</li>
                        <li>Utilizar linguagem ofensiva ou xingamentos diretos em avaliações ou interações indevidas    ;</li>
                        <li>Enviar avaliações sequenciais com objetivo de manipular ou sobrecarregar a listagem de comentários (“flood”);</li>
                        <li>Tentar fraudar ou manipular o sistema de reputação da plataforma.</li>
                    </ul>
                </div>

                <p><strong>3.3 Penalidades</strong></p>
                <div class="ms-3 mb-3">
                    O descumprimento de qualquer item destes termos poderá resultar em:
                    <ul>
                        <li>Advertência;</li>
                        <li>Suspensão temporária da conta;</li>
                        <li>Banimento permanente do usuário.</li>
                    </ul>
                </div>

                <p><strong>3.4 Usuário como Cliente</strong></p>
                <div class="ms-3 mb-3">
                    O cliente é responsável por verificar a confiabilidade dos prestadores antes de efetuar o agendamento, e por utilizar os recursos da plataforma de maneira consciente.
                </div>

                <p><strong>3.5 Usuário como Prestador de Serviços</strong></p>
                <div class="ms-3 mb-3">
                    O prestador deve garantir a veracidade das informações fornecidas, manter conduta profissional e cumprir com os prazos e condições oferecidos.
                </div>
            </div>

            <p><strong>4 - Privacidade</strong></p>
            <div class="ms-4 mb-4">
                A ServiNow atua apenas como intermediadora e não compartilha informações dos usuários com terceiros, salvo por obrigação legal. Os dados são utilizados unicamente para o funcionamento do sistema.
            </div>

            <p><strong>4.1 Sistema de Denúncia</strong></p>
            <div class="ms-4 mb-4">
                A plataforma disponibiliza um meio para denúncia de condutas inadequadas, que é o e-mail dos desenvolvedores. Todas as denúncias são analisadas pela equipe do ServiNow com confidencialidade e imparcialidade.
            </div>

            <p><strong>5 - Proteção de Dados</strong></p>
            <div class="ms-4 mb-4">
                Os dados dos usuários (nome, e-mail, preferências, avaliações, etc.) são armazenados com segurança, conforme a Lei Geral de Proteção de Dados (LGPD - Lei nº 13.709/2018). O usuário pode solicitar a atualização ou exclusão de seus dados a qualquer momento.
            </div>

            <p><strong>6 - Disposições Finais</strong></p>
            <div class="ms-4 mb-4">
                A ServiNow poderá alterar estes Termos de Uso e Política de Privacidade a qualquer momento, com aviso prévio por e-mail ou na própria plataforma. O uso contínuo após as alterações indica concordância com os novos termos.
            </div>
            <div class="mb-4">
                E-mails dos desenvolvedores: <br>
                José Claion Martins de Sousa (joseclaionmartins@gmail.com) <br>
                João Victor Brum de Castro (joaovictor.brumc@gmail.com) <br>
                Matheus Pantoja de Morais (mateus4pantoja@gmail.com) <br>
                Manoel de Jesus Moreira de Aguiar (manoelmaguiar@gmail.com) <br>
            </div>
        </div>
    </div>
@endsection
