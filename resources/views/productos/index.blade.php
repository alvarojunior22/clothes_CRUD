<x-app-layout>
    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Productos</h2>
            <p class="text-sm text-gray-500">
                Administra los productos de tu catálogo
            </p>
        </div>

        <button
            type="button"
            id="openCreateBtn"
            class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5
                   rounded-lg font-medium hover:bg-blue-700 transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            Nuevo producto
        </button>
    </div>

    <!-- CARD -->
    <div id="app"
        data-user-id="{{ auth()->id() }}"
        data-is-admin="{{ auth()->user()->isAdmin() ? 'true' : 'false' }}"
        class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <!-- TABLE WRAPPER -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr class="text-xs uppercase tracking-wider text-gray-500">
                        <th class="px-6 py-4 text-center w-20">Imagen</th>
                        <th class="px-6 py-4 text-left">Producto</th>
                        <th class="px-6 py-4 text-left">Categoría</th>
                        <th class="px-6 py-4 text-left">Precio</th>
                        <th class="px-6 py-4 text-left">Stock</th>
                        <th class="px-6 py-4 text-left">Estado</th>
                        <th class="px-6 py-4 text-right w-56">Acciones</th>
                    </tr>
                </thead>


                <tbody
                    id="productos-body"
                    class="divide-y divide-gray-100 bg-white">
                    <!-- JS renderiza aquí -->
                </tbody>
            </table>
        </div>

        <!-- FOOTER / PAGINACIÓN -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between
                    gap-4 px-6 py-4 border-t border-gray-200 bg-gray-50">

            <p class="text-sm text-gray-500">
                Mostrando productos del catálogo
            </p>

            <div id="pagination"
                class="flex items-center gap-1">
                <!-- JS renderiza aquí -->
            </div>
        </div>
    </div>

    {{-- MODALES --}}
    @include('productos.modals.create')
    @include('productos.modals.edit')
    @include('productos.modals.delete-confirm')
    @include('productos.modals.ViewModal')
</x-app-layout>