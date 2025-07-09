@extends('layouts.autenticado')

@section('title', 'Agendamentos')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow w-100" style="max-width: 1200px">

            <h1 class="text-center mb-4">Seus serviços cadastrados</h1>

            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Serviço</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tbody>
                        @foreach ($servicos as $item)
                            <tr>
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->nome_servico ? $item->nome_servico : 'Status não encontrado.'}} </td>
                                <td> {{ $item->created_at->format('d/m/Y')}} {{ $as = "as" }}  {{ $item->created_at->format('H:i') }}</td>
                                <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href=" {{ route('servico.edit', ['servico' => $item->id]) }} ">
                                        <img class="list_icons" src="{{ asset('images/edit.png') }}" alt="Editar">
                                    </a>
                                    <form action=" {{ route('servico.destroy', ['servico' => $item->id]) }} " method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete_icon_button bg-transparent border-0 p-0">
                                            <img class="list_icons" src="{{ asset('images/delete.png') }}" alt="Excluir conta">
                                        </button>
                                    </form>
                                </div>
                            </td>
                            </tr>

                        @endforeach
                    </tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
