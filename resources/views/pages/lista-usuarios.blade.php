<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    
</head>
<body>
    
    <div>
        <table class="table text-center" text-center">
            <tr class="column">
                <th class = "px-3 py-3 fs-3">ID</th>
                <th class = "px-3 py-3 fs-3">NOME</th>
                <th class = "px-3 py-3 fs-3">E-MAIL</th>
                <th class = "px-3 py-3 fs-3">TELEFONE</th>
                <th class = "px-3 py-3 fs-3">CPF/CNPJ</th>
                <th class = "px-3 py-3 fs-3">ATUAÇÃO</th>
            </tr>
            <tr id="rows" class="">
                <td>{{ $teste = "===" }}</td>
                <td>{{ $teste = "===" }} </td>
                <td>{{ $teste = "===" }} </td>
                <td>{{ $teste = "===" }} </td>
                <td>{{ $teste = "===" }} </td>
                <td>{{ $teste = "===" }} </td>
            </tr>
        </table>
    </div>
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>