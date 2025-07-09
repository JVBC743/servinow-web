<?php

namespace Database\Seeders;
use App\Models\Categoria;
use App\Models\Formacao;
use App\Models\Usuario;
use App\Models\Servico;
use App\Models\Agendamento;
use App\Models\StatusAgendamento;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        StatusAgendamento::insert([
            ['status' => 'Em progresso'],
            ['status' => 'Finalizado com sucesso'],
            ['status' => 'Finalizado sem sucesso'],
        ]);

        Categoria::factory()->count(10)->create();
        Formacao::factory()->count(10)->create();
        Usuario::factory()->count(50)->create();
        Servico::factory()->count(50)->create();
        Agendamento::factory()->count(20)->create();
    }
}
