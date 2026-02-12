<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
  public function run(): void
  {
    $categorias = [
      'Camisetas',
      'Chaquetas',
      'Pantalones',
      'Sudaderas',
      'Gorras',
      'Zapatos',
    ];

    foreach ($categorias as $nombre) {
      Categoria::create(['nombre' => $nombre]);
    }
  }
}
