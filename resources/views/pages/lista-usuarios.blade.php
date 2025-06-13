<x-navbar :title="'Lista de Usuários'" />

<body>
    
    <div>
        <table class="table text-center">
            <tr>
                <th class = "px-3 py-3 fs-3 column">ID</th>
                <th class = "px-3 py-3 fs-3 column">NOME</th>
                <th class = "px-3 py-3 fs-3 column">E-MAIL</th>
                <th class = "px-3 py-3 fs-3 column">TELEFONE</th>
                <th class = "px-3 py-3 fs-3 column">CPF/CNPJ</th>
                <th class = "px-3 py-3 fs-3 column">ATUAÇÃO</th>
            </tr>

            @foreach ($lista as $usr)
                <tr id="rows" class="">
                    <td>{{ $usr['id'] }}</td>
                    <td>{{ $usr['nome'] }}</td>
                    <td>{{ $usr['telefone'] }} </td>
                    <td>{{ $usr['email'] }} </td>
                    <td>{{ $usr['cpf_cnpj'] }} </td>
                    <td>{{ $usr['nome_atuacao'] }} </td>
                </tr>
            @endforeach
        </table>
    </div>
    
<x-footer />

</body>
</html>