<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Formacao;

class FormacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formacao = [
            'Engenheiro',
            'Carpinteiro',
            'Técnico de informática',
            'Desenvolvedor',
            'Arquiteto',
            'Técnico de redes',
            'Designer Gráfico',
            'Engenheiro mecânico',
            'Eletreecista',
        ];
        foreach ($formacao as $nome) {
            Formacao::create(['formacao' => $nome]);
        } 
    }
}
