@extends('layout.app')

@section('content')



<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Productos</h2>

    <button
        type="button"
        onclick="openCreateModal()"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        + Nuevo producto
    </button>
</div>

<div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-200" id="app">
    <table class="min-w-full text-sm text-gray-700">
        <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
            <tr>
                <th class="px-6 py-4 text-left">Producto</th>
                <th class="px-6 py-4 text-left">Categoría</th>
                <th class="px-6 py-4 text-left">Precio</th>
                <th class="px-6 py-4 text-left">Stock</th>
                <th class="px-6 py-4 text-right">Acciones</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200" id="productos-body">
            <!-- Aquí se insertaran los productos -->
        </tbody>
    </table>

    <script>
        const USER_ID = {{auth()->id()}};
        const IS_ADMIN = {{auth()->user()->isAdmin() ? 'true' : 'false'}};
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
</div>

{{-- PAGINACIÓN --}}
<div class="mt-6">
    {{ $productos->links() }}
</div>

{{-- MODALES --}}
@include('productos.modals.create')
@include('productos.modals.edit')

@endsection