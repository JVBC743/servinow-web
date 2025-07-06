<?php

namespace Database\Factories;

use App\Models\Formacao;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
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
            'nome' => $this->faker->name(),
            'senha' => static::$password ??= Hash::make('password'),
            'descricao' => $this->faker->optional()->paragraph(),
            'telefone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),

            // Geração condicional de CPF (11) ou CNPJ (14)
            'cpf_cnpj' => $this->faker->boolean(70)
                ? $this->faker->numerify('###########')       // CPF
                : $this->faker->numerify('##############'),   // CNPJ

            // Verifica se há registros em Formacao antes de pegar um id
            'area_atuacao' => function () {
                $formacao = Formacao::inRandomOrder()->first();
                return $formacao ? $formacao->id : Formacao::factory()->create()->id;
            },

            'caminho_img' => $this->faker->optional()->imageUrl(640, 480),
            'rede_social1' => $this->faker->optional()->userName(),
            'rede_social2' => $this->faker->optional()->userName(),
            'rede_social3' => $this->faker->optional()->userName(),
            'rede_social4' => $this->faker->optional()->userName(),

            'cep' => $this->faker->postcode(),
            'logradouro' => $this->faker->streetName(),
            'numero' => $this->faker->buildingNumber(),
            'complemento' => $this->faker->optional()->secondaryAddress(),
            'bairro' => $this->faker->citySuffix(),
            'cidade' => $this->faker->city(),
            'uf' => $this->faker->randomElement([
                'AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT',
                'MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO',
                'RR','SC','SP','SE','TO'
            ]),
        ];
    }
}
