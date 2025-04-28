<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = $this->faker->image(public_path('storage/productos'), 640, 480, null, false);

        return [
            'sku' => $this->faker->unique()->word(),
            'nombre' => $this->faker->word(3),
            'descripcion' => $this->faker->text(100),
            // Aquí usamos la ruta de la imagen generada
            'imagen' => 'productos/' . $imagePath,
            'precio' => $this->faker->randomFloat(2, 1, 1000),
            'id_subcategoria' => $this->faker->numberBetween(1, 10),
            'id_provedor' => $this->faker->numberBetween(1, 10),
        ];
    }
}
