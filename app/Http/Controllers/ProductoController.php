<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;



class ProductoController extends Controller
{
    
    
    public function index()
    {

        $categorias = Categoria::all();
        return view('productos.index', compact('categorias'));
    }

    
    
}
