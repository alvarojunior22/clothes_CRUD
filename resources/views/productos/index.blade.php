<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Productos</h2>

        <button
            type="button"
            onclick="openCreateModal()"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Nuevo producto
        </button>
    </div>

    <div id="app"
        data-user-id="{{ auth()->id() }}"
        data-is-admin="{{ auth()->user()->isAdmin() ? 'true' : 'false' }}"
        class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-200">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">Producto</th>
                    <th class="px-6 py-4 text-left">Categoría</th>
                    <th class="px-6 py-4 text-left">Precio</th>
                    <th class="px-6 py-4 text-left">Stock</th>
                    <th class="px-6 py-4 text-left">status</th>
                    <th class="px-24 py-4 text-right">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200" id="productos-body">
                <!-- Aquí se insertaran los productos -->
            </tbody>

        </table>

        <div id="pagination" class="flex justify-end gap-2 mb-4 mt-5 items-center   "></div>




        <script src="{{ asset('js/app.js') }}"></script>
    </div>



    {{-- MODALES --}}
    @include('productos.modals.create')
    @include('productos.modals.edit')
    @include('productos.modals.delete-confirm')

</x-app-layout>