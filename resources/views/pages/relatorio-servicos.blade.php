<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Serviços</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        .table-header {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Relatório de Serviços</h1>
    <h2>{{ $usuario->nome }}</h2>

    <p><strong>Data do Relatório:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    <p><strong>Total de Serviços:</strong> {{ $servicos->count() }}</p>

    <table>
        <thead class="table-header">
            <tr>
                <th>#</th>
                <th>Nome do Serviço</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Data de Criação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicos as $servico)
                <tr>
                    <td>{{ $servico->id }}</td>
                    <td>{{ $servico->nome_servico }}</td>
                    <td>{{ $servico->categoriaR->nome ?? 'Não informada' }}</td>
                    <td>{{ $servico->desc_servico }}</td>
                    <td>{{ $servico->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
