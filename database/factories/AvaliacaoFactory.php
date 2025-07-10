<?php

namespace Database\Factories;
use App\Models\Usuario;
use App\Models\Servico;
use App\Models\Avaliacao;



use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avaliacao>
 */
class AvaliacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Avaliacao::class;

    public function definition(): array
    {
        return [
            'nota' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->sentence(),
            'id_cliente' => Usuario::factory(),
            'id_servico' => Servico::factory(),
        ];
    }
}