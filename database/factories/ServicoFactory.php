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
            'caminho_foto' => $this->faker->imageUrl(640, 480, 'technics'),
            'usuario_id' => Usuario::inRandomOrder()->first()->id ?? Usuario::factory(),
        ];
    }
}
