<?php



namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\Producto\validacionesRequest as ProductoRequest;
use Illuminate\Support\Facades\Storage;

class ProductoDataController extends Controller
{
  public function index()
  {
    $user = auth()->user();

    return $user->isAdmin()
      ? Producto::with('categoria')->paginate(10)
      : Producto::with('categoria')
      ->where('user_id', $user->id)
      ->get();
  }


  public function store(ProductoRequest $request)
  {
    $path = null;

    if($request->hasFile('imagen')) {
      $path = $request->file('imagen')->store('productos', 'public');
    }

    $producto = Producto::create([
      'nombre'        => $request->nombre,
      'categoria_id'  => $request->categoria_id,
      'precio'        => $request->precio,
      'stock'         => $request->stock,
      'user_id'       => auth()->id(),
      'imagen'        => $path,
    ]);

    return response()->json($producto, 201);
  }


  public function update(ProductoRequest $request, Producto $producto)
  {
    $this->authorizeProducto($producto);

    $data = $request->validated();

    
    unset($data['imagen']);

    if ($request->hasFile('imagen')) {
      if ($producto->imagen) {
        Storage::disk('public')->delete($producto->imagen);
      }

      $producto->imagen = $request->file('imagen')->store('productos', 'public');
    }

    $producto->update($data);

    return $producto;
  }


  public function show(Producto $producto)
  {
    $this->authorizeProducto($producto);
    return $producto->load('categoria');
  }


  public function destroy(Producto $producto)
  {
    $this->authorizeProducto($producto);

    if ($producto->imagen) {
      Storage::disk('public')->delete($producto->imagen);
    }

    $producto->delete();

    return response()->json(['message' => 'Producto eliminado']);
  }

  private function authorizeProducto(Producto $producto)
  {
    if (!auth()->user()->isAdmin() && $producto->user_id !== auth()->id()) {
      abort(403);
    }
  }
}
