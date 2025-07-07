<?php

namespace Database\Factories;

use App\Models\Formacao;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'senha' => static::$password ??= Hash::make('password'),
            'descricao' => $this->faker->optional()->paragraph(),
            'telefone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf_cnpj' => $this->faker->numerify('###########'), // até 14 dígitos
            'area_atuacao' => Formacao::inRandomOrder()->first()?->id ?? 1, // previne erro se não houver dados
            'caminho_img' => 'imagens/usuarios/' . $this->faker->uuid() . '.jpg',

            'rede_social1' => $this->faker->optional()->url(),
            'rede_social2' => $this->faker->optional()->url(),
            'rede_social3' => $this->faker->optional()->url(),
            'rede_social4' => $this->faker->optional()->url(),

            'cep' => $this->faker->postcode(),
            'logradouro' => $this->faker->streetName(),
            'numero' => $this->faker->buildingNumber(),
            'complemento' => $this->faker->optional()->secondaryAddress(),
            'bairro' => $this->faker->citySuffix(),
            'cidade' => $this->faker->city(),
            'uf' => $this->faker->stateAbbr(),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
