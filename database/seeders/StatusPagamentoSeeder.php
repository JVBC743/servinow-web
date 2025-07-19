<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusPagamento;

class StatusPagamentoSeeder extends Seeder
{
    public function run(): void
    {
        $status = [
            ['status' => 'Pendente'],
            ['status' => 'Pago'],
            ['status' => 'Cancelado'],
            ['status' => 'Reembolsado'],
        ];

        foreach ($status as $item) {
            StatusPagamento::firstOrCreate(['status' => $item['status']]);
        }
    }
}
