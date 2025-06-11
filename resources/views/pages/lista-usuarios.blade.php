<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">

</head>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>