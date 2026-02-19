<div id="createModal"
    class="fixed inset-0 z-50 hidden bg-black/60 flex items-center justify-center px-4">

    <div
        class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-8 py-5 border-b">
            <div>
                <h3 class="text-xl font-semibold text-gray-900">
                    Crear producto
                </h3>
                <p class="text-sm text-gray-500">
                    Agrega un nuevo producto a tu catálogo
                </p>
            </div>

            <button id="createCloseBtn"
                class="text-gray-400 hover:text-gray-600 text-2xl leading-none">
                &times;
            </button>
        </div>

        <!-- BODY -->
        <form id="createProductoForm"
            method="POST"
            enctype="multipart/form-data"
            class="px-8 py-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- LEFT -->
                <div class="md:col-span-2 space-y-5">

                    <!-- Nombre -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Nombre del producto
                        </label>
                        <input
                            name="nombre"
                            required
                            placeholder="Ej: Camiseta Oversize Negra"
                            class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-300
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Categoría -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">
                            Categoría
                        </label>
                        <select
                            name="categoria_id"
                            required
                            class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-300
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Selecciona una categoría</option>
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Precio / Stock -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Precio
                            </label>
                            <input
                                name="precio"
                                type="number"
                                step="0.01"
                                required
                                placeholder="0.00"
                                class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-300
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">
                                Stock
                            </label>
                            <input
                                name="stock"
                                type="number"
                                required
                                placeholder="0"
                                class="w-full mt-1 px-4 py-2.5 rounded-lg border border-gray-300
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- RIGHT: IMAGEN -->
                <div class="flex flex-col items-center">
                    <div
                        id="imagePreview"
                        class="w-48 h-48 rounded-xl border-2 border-dashed border-gray-300
               flex items-center justify-center overflow-hidden mb-3 bg-gray-50">

                        <span id="imagePlaceholder" class="text-gray-400 text-sm">
                            Vista previa
                        </span>

                        <img id="previewImg"
                            class="hidden w-full h-full object-cover">
                    </div>

                    <input type="file"
                        name="imagen"
                        id="imagenInput"
                        accept="image/*"
                        class="text-sm text-gray-600">
                </div>

            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-4 mt-10 pt-6 border-t">
                <button type="button"
                    id="createCancelBtn"
                    class="px-5 py-2.5 rounded-lg border border-gray-300
                           text-gray-700 hover:bg-gray-100">
                    Cancelar
                </button>

                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white
                           hover:bg-blue-700 font-medium shadow">
                    Guardar producto
                </button>
            </div>
        </form>
    </div>
</div>