<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StatusAgendamento;
use App\Models\Usuario;
use App\Models\Servico;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agendamento>
 */
class AgendamentoFactory extends Factory
{
    protected $model = \App\Models\Agendamento::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'id_cliente' => Usuario::factory(),
            'id_servico' => Servico::factory(),
            'id_prestador' => Usuario::factory(),
            'data_agendamento' => $this->faker->dateTimeBetween('+1 day', '+1 month'),
            'status' => StatusAgendamento::inRandomOrder()->value('id'),
            'notificacao' => $this->faker->boolean(),
        ];
    }
}