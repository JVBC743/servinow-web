<?php

namespace Database\Seeders;
use App\Models\Categoria;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categorias = [
            'Esportes',
            'Tecnologia',
            'Moda',
            'Saúde',
            'Educação',
            'Música',
            'Conserto',
            'Marcenaria',
        ];

        foreach ($categorias as $nome) {
            Categoria::create(['nome' => $nome]);
        }
    }
}
