@extends('layouts.autenticado')

@section('title', 'ServinNow - Agendar Serviço')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 900px">

            <h1 class="text-center mb-4">Agendar Serviço</h1>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($usr)
                <form action="{{ route('agendar.servico', $usr->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Nome do Prestador --}}
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Nome do Prestador*</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $usr->nome) }}" maxlength="50" required>
                        </div>

                        {{-- Descrição do Serviço --}}
                        <div class="col-12 mb-3">
                            <label for="descricao" class="form-label">Descrição do Serviço (max 300 caracteres)</label>
                            <textarea name="descricao" id="descricao" class="form-control" maxlength="300" rows="4" placeholder="Adicione uma breve descrição do serviço">{{ old('descricao', $usr->descricao) }}</textarea>
                        </div>

                        {{-- Data de Agendamento --}}
                        <div class="col-md-6 mb-3">
                            <label for="data" class="form-label">Data*</label>
                            <input type="date" name="data" id="data" class="form-control" value="{{ old('data') }}" required>
                        </div>

                        {{-- Redes Sociais --}}
                        <div class="col-md-6 mb-3">
                            <label for="rede_social1" class="form-label">Rede Social #1</label>
                            <input type="text" name="rede_social1" id="rede_social1" class="form-control" maxlength="40" value="{{ old('rede_social1', $usr->rede_social1) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rede_social2" class="form-label">Rede Social #2</label>
                            <input type="text" name="rede_social2" id="rede_social2" class="form-control" maxlength="40" value="{{ old('rede_social2', $usr->rede_social2) }}">
                        </div>

                        {{-- Foto do Serviço --}}
                        <div class="d-flex justify-content-center mt-5 mb-3">
                            <div class="d-flex flex-column align-items-center" style="width: 200px;">
                                @if($imagem_url)
                                    <img src="{{ $imagem_url }}" alt="Foto do Serviço" class="profile_img mb-3" style="width: 400px">
                                @else
                                    <img src="{{ asset('images/service-icon.png') }}" alt="Serviço sem foto" class="profile_img mb-3" style="width: 400px">
                                @endif
                                <input type="file" name="foto" accept="image/*" class="form-control w-100" style="max-width: 150px;">
                                <small class="text-muted mt-1">Anexar nova imagem</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4 w-100">
                        <button type="submit" class="btn btn-primary px-5">Agendar</button>
                    </div>
                </form>
            @else
                <h3 class="text-center text-danger">Usuário não encontrado, por favor, volte.</h3>
            @endif
        </div>
    </div>
@endsection