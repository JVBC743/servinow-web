@extends ('layouts.autenticado')
@section('title', 'Dashboard')
@section('content')


<div class="d-flex align-items-center justify-content-between gap-2"> 
    <h1 class="m-0">Serviços Disponíveis</h1>
    <div class="flex-grow-1 ms-3" style="max-width: 400px;">
        <x-search-bar />
    </div>
</div>














@endsection