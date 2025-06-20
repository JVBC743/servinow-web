<x-header :title="'Lista de Usuários'" />

<body>
    
    <div>
        <table class="table text-center">
            <tr>
                <th class = "px-3 py-3 fs-3 column">ID</th>
                <th class = "px-3 py-3 fs-3 column">NOME</th>
                <th class = "px-3 py-3 fs-3 column">TELEFONE</th>
                <th class = "px-3 py-3 fs-3 column">E-MAIL</th>
                <th class = "px-3 py-3 fs-3 column">CPF/CNPJ</th>
                <th class = "px-3 py-3 fs-3 column">AÇÕES</th>
            </tr>

            @foreach ($lista as $usr)
                <tr id="rows" class="">
                    <td>{{ $usr['id'] }}</td>
                    <td>{{ $usr['nome'] }}</td>
                    <td>{{ $usr['telefone'] }} </td>
                    <td>{{ $usr['email'] }} </td>
                    <td>{{ $usr['cpf_cnpj'] }} </td>
                    {{-- <td>{{ $usr['nome_atuacao'] }} </td> --}}
                    <td>
                        <div class="d-flex justify-content-between">
                            <div class="ms-5">
                                <a href="">
                                    <img class="list_icons" src="{{ asset('images/edit.png') }}" alt="">
                                </a>
                            </div>
                            <div class="me-5 justify-content-end">
                                <a href="">
                                    <img class="list_icons" src="{{ asset('images/delete.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </td>
                   
                </tr>
            @endforeach
        </table>
    </div>
    
<x-footer />