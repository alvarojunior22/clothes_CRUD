<?php

namespace App\Http\Controllers;


use App\Models\Producto;



class ProductoController extends Controller
{
    
    
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $productos = Producto::paginate(10);
        } else {
            $productos = Producto::where('user_id', $user->id)->paginate(10);
        }

        return view('productos.index', compact('productos'));
    }

    
}
