<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Producto\validacionesRequest;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductoApiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $productos = $user->isAdmin()
            ? Producto::all()
            : Producto::where('user_id', $user->id)->get();

        return response()->json($productos);
    }

    public function store(validacionesRequest $request)
    {
        $imagenPath = $request->file('imagen')?->store('public/imagenes');

        $producto = Producto::create([
            'nombre'    => $request->nombre,
            'categoria' => $request->categoria,
            'precio'    => $request->precio,
            'stock'     => $request->stock,
            'user_id'   => auth()->id(),
            'imagen'    => $imagenPath,
        ]);

        return response()->json($producto, 201);
    }

    public function update(validacionesRequest $request, Producto $producto)
    {
        if (!auth()->user()->isAdmin() && $producto->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::delete($producto->imagen);
            }
            $producto->imagen = $request->file('imagen')->store('public/imagenes');
        }

        $producto->update([
            'nombre'    => $request->nombre,
            'categoria' => $request->categoria,
            'precio'    => $request->precio,
            'stock'     => $request->stock,
        ]);

        return response()->json($producto);
    }

    public function destroy(Producto $producto)
    {
        if (!auth()->user()->isAdmin() && $producto->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        if ($producto->imagen) {
            Storage::delete($producto->imagen);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado']);
    }
}
