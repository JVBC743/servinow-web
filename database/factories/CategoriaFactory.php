<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
            // Usando campo 'categoria' conforme seu model
            'nome' => $this->faker->word(),
        ];
    }
}
