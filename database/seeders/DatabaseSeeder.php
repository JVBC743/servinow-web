<?php

namespace Database\Seeders;
use App\Models\Categoria;
use App\Models\Formacao;
use App\Models\Usuario;
use App\Models\Servico;
use App\Models\Agendamento;
use App\Models\StatusAgendamento;
use App\Models\Avaliacao;

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

        $this->call([
            CategoriaSeeder::class,
            StatusAgendamentoSeeder::class,
            FormacaoSeeder::class,
        ]);
        
        // Formacao::factory()->count(10)->create();
        // Usuario::factory()->count(10)->create();
        // Servico::factory()->count(10)->create();
        // Agendamento::factory()->count(10)->create();
        // Avaliacao::factory()->count(10)->create();
    }
}
