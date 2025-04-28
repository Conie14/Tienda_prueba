<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProvedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            //'apellidos' => $this->faker->lastName(),
            //telefono a 10 digitos
            'telefono' => $this->faker->numberBetween(1000000000, 9999999999),            
            'email' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->address(),
            
        ];
    }
}
