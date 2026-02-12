<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        $nombresRopa = [
            'Camiseta básica',
            'Chaqueta denim',
            'Pantalón cargo',
            'Sudadera oversized',
            'Hoodie premium',
            'Camiseta estampada',
            'Pantalón slim',
            'Chaqueta impermeable',
        ];

        return [
            'nombre'       => $this->faker->randomElement($nombresRopa),
            'categoria_id' => Categoria::inRandomOrder()->first()->id,
            'precio'       => $this->faker->randomFloat(2, 30, 300),
            'stock'        => $this->faker->numberBetween(1, 100),
            'user_id'      => User::inRandomOrder()->first()->id,
            'imagen'       => null,
        ];
    }
}
