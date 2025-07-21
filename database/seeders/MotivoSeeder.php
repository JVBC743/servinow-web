<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Motivo;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motivos = [
            'Fraude',
            'Conteúdo sexual',
            'Venda ilegal de entorpecentes',
            'Discriminação',
            'Apologia ao crime',
            'Assédio',
            'Atividade suspeita',
            'Spam',
        ];

        foreach ($motivos as $nome) {
            Motivo::create(['motivo' => $nome]);
        }
    }
}
