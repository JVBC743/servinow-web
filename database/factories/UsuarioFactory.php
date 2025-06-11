<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UsuarioFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            //'email_verified_at' => now(),
            'senha' => static::$password ??= Hash::make('password'),
            'telefone' => fake()->phoneNumber(),
            'cpf_cnpj' => fake()->randomNumber(8),
            'area_atuacao' => \App\Models\Formacao::inRandomOrder()->first()->id,

            //'remember_token' => Str::random(10),

        // public int $id,
        // public string $nome,
        // public string $senha,
        // public string $telefone,
        // public string $email,
        // public string $cpf_cnpj,
        // public Formacao $area_atuacao,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
