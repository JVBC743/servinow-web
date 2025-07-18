<?php

namespace Database\Factories;

use App\Models\StatusAgendamento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusAgendamento>
 */
class StatusAgendamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => StatusAgendamento::factory(),

        ];
    }
}
