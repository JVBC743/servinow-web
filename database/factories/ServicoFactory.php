<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Servico;
use App\Models\Categoria;
use App\Models\Usuario;

class ServicoFactory extends Factory
{
    protected $model = Servico::class;

    public function definition()
    {
        return [
            'nome_servico' => $this->faker->sentence(3),
            'categoria' => Categoria::factory(),
            'desc_servico' => $this->faker->paragraph(),
            'caminho_foto' => 'imagens/servicos/' . $this->faker->image('storage/app/public/imagens/servicos', 640, 480, null, false),
            // Aqui pega um usuário aleatório existente
            'usuario_id' => Usuario::inRandomOrder()->first()->id ?? Usuario::factory(),
        ];
    }
}
