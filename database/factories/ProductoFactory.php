<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'categoria' => $this->faker->randomElement(['Camisas', 'Pantalones', 'Zapatos', 'Chaquetas']),
            'precio' => $this->faker->randomFloat(2, 20, 300),
            'stock' => $this->faker->numberBetween(1, 100),
            'categoria_id' => Categoria::factory(),
            'user_id' => User::factory()
        ];
    }
}
