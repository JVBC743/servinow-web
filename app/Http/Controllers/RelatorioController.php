<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function servicos()
    {
        $usuario = auth()->user();

        // Carrega os serviços com média da nota
        $servicos = $usuario->servicos()
            ->with('categoriaR')
            ->withAvg('avaliacoes', 'nota')
            ->get()
            ->map(function ($servico) {
                $servico->media_nota = $servico->avaliacoes_avg_nota ?? 0;
                return $servico;
            });

        // Agendamentos do prestador agrupados por mês e serviço
        $agendamentos = Agendamento::with('servico')
            ->where('id_prestador', $usuario->id)
            ->get();

        $agendamentosPorMes = [];

        foreach ($agendamentos as $agendamento) {
            $mes = $agendamento->data_agendamento->format('m/Y');
            $nomeServico = $agendamento->servico->nome_servico ?? 'Desconhecido';

            if (!isset($agendamentosPorMes[$mes])) {
                $agendamentosPorMes[$mes] = [
                    'total' => 0,
                    'servicos' => []
                ];
            }

            $agendamentosPorMes[$mes]['total']++;

            if (!isset($agendamentosPorMes[$mes]['servicos'][$nomeServico])) {
                $agendamentosPorMes[$mes]['servicos'][$nomeServico] = 0;
            }

            $agendamentosPorMes[$mes]['servicos'][$nomeServico]++;
        }

        $pdf = Pdf::loadView('pages.relatorio-servicos', compact('usuario', 'servicos', 'agendamentosPorMes'));
        return $pdf->download('relatorio-servicos.pdf');
    }
}
