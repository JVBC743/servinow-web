<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MetodoPagamento;

class MetodoPagamentoSeeder extends Seeder
{
    public function run(): void
    {
        $metodos = [
            ['metodo' => 'PIX'],
            ['metodo' => 'Cartão de Crédito'],
            ['metodo' => 'Cartão de Débito'],
            ['metodo' => 'Boleto Bancário'],
        ];

        foreach ($metodos as $item) {
            MetodoPagamento::firstOrCreate(['metodo' => $item['metodo']]);
        }
    }
}
