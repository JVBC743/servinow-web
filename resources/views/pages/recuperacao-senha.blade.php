@extends('layouts.nao-autenticado')

@section('title', 'Recuperar senha')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
            <h4 class="mb-4 text-center">Recuperar Senha</h4>

            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{-- {{ session('status') }} --}}
                </div>
            @endif

            <form method="post" action="
            {{-- {{ route('password.email') }} --}}
             ">
                @csrf

                <div class="form-group mb-3">
                    <label for="telefone">Telefone (WhatsApp)</label>
                    <input id="telefone" type="text" name="telefone" class="form-control" placeholder="(99) 99999-9999">

                    @error('email')
                        <span class="invalid-feedback d-block mt-1" role="alert">
                            {{-- <strong>{{ $message }}</strong> --}}
                        </span>
                    @enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success w-100">
                        Enviar link de redefinição
                    </button>
                    <a href="{{ route('login') }}"> <!-- TROCAR A ROTA -->
                        <button class="btn btn-secondary">
                            Voltar
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
