@extends('layouts.autenticado')

@section('title', 'Agendamentos')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 1200px">

            <h1 class="text-center mb-4">Seus serviços agendados</h1>

            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Serviço</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TESTE</td>
                        <td>TESTE</td>
                        <td>TESTE</td>
                        <td>TESTE</td>
                        <td>TESTE</td>
                        <td>TESTE</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
