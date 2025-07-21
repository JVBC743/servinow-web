<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusAgendamento;

class StatusAgendamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            'Aguardando confirmação',
            'Em progresso',
            'Finalizado com sucesso',
            'Finalizado sem sucesso',
            'Aguardando pagamento',
            'pago',
        ];
        foreach ($status as $nome) {
            StatusAgendamento::create(['status' => $nome]);
        }
    }
}
