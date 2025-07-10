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

            <form method="POST" action="
            {{-- {{ route('password.email') }} --}}
             ">
                @csrf

                <div class="form-group mb-3">
                    <label for="email">E-mail</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}"
                        required autocomplete="email" autofocus
                        placeholder="exemplo@email.com">

                    @error('email')
                        <span class="invalid-feedback d-block mt-1" role="alert">
                            {{-- <strong>{{ $message }}</strong> --}}
                        </span>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success w-100">
                        Enviar link de redefinição
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
