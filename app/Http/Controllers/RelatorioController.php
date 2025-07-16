<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function servicos()
    {
        $usuario = auth()->user();
        $servicos = $usuario->servicos()->with('categoriaR')->get(); // ajuste se a relação for diferente
        $pdf = Pdf::loadView('pages.relatorio-servicos', compact('usuario', 'servicos'));
        return $pdf->download('relatorio-servicos.pdf');
    }
}
