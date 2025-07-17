<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Serviços</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.5;
        }

        h1, h2, h3 {
            text-align: center;
            margin: 10px 0;
        }

        p {
            margin: 4px 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .section-title {
            margin-top: 40px;
            font-size: 16px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
        }

        .summary {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Relatório de Serviços</h1>
    <h2>{{ $usuario->nome }}</h2>

    <div class="info">
        <p><strong>Data do Relatório:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        <p><strong>Total de Serviços Cadastrados:</strong> {{ $servicos->count() }}</p>
    </div>

    <h3 class="section-title">Lista de Serviços</h3>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome do Serviço</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Data de Criação</th>
                <th>Média de Avaliação</th>
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
                    <td>{{ number_format($servico->media_nota, 1) }}/5</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">Agendamentos por Mês</h3>

    @forelse ($agendamentosPorMes as $mes => $dados)
        <h4>{{ $mes }}</h4>
        <p class="summary">Total de agendamentos: {{ $dados['total'] }}</p>

        <table>
            <thead>
                <tr>
                    <th>Serviço</th>
                    <th>Agendamentos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados['servicos'] as $nome => $quantidade)
                    <tr>
                        <td>{{ $nome }}</td>
                        <td>{{ $quantidade }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @empty
        <p>Nenhum agendamento encontrado neste período.</p>
    @endforelse

</body>
</html>
