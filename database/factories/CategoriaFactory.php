<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria' => fake()->randomElement(['
            Esportes', 
            'Tecnologia',
            'Moda', 
            'Saúde', 
            'Educação', 
            'Música', 
            'Conserto', 
            'Mercenaria'
        
        
        ]),

=======
use App\Models\Categoria;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
            // Usando campo 'categoria' conforme seu model
            'nome' => $this->faker->word(),
>>>>>>> e4fa30f861af16f6742b9b73339e6610ebe0a8d9
        ];
    }
}
