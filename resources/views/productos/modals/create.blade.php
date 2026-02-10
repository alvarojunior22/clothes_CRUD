<div id="createModal"
    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

    <div id="createModalContent"
        class="bg-white text-gray-800 w-full max-w-4xl rounded-2xl shadow-2xl p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h3 class="text-xl font-semibold text-gray-800">
                Nuevo Producto
            </h3>

            <button onclick="closeCreateModal()"
                class="text-gray-400 hover:text-gray-600 text-2xl">
                &times;
            </button>
        </div>

        <!-- BODY -->
        <form method="POST"
            id="createProductoForm"
            enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- LEFT: FORM -->
                <div class="md:col-span-2 space-y-5">

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Nombre
                        </label>
                        <input name="nombre"
                            class="modal-input text-gray-800 bg-gray-100"
                            placeholder="Nombre del producto"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Categoría
                        </label>
                        <input name="categoria"
                            class="modal-input text-gray-800 bg-gray-100"
                            placeholder="Categoría"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">
                                Precio
                            </label>
                            <input name="precio"
                                type="number"
                                step="0.01"
                                class="modal-input text-gray-800 bg-gray-100"
                                placeholder="0.00"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">
                                Stock
                            </label>
                            <input name="stock"
                                type="number"
                                class="modal-input text-gray-800 bg-gray-100"
                                placeholder="0"
                                required>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: IMAGE -->
                <div class="flex flex-col items-center justify-center">
                    <div class="w-48 h-48 rounded-xl bg-gray-100 border-2 border-dashed border-gray-300
                                flex items-center justify-center text-gray-400 mb-4">
                        Imagen
                    </div>

                    <input type="file"
                        name="imagen"
                        accept="image/*"
                        class="text-sm text-gray-600">
                </div>
            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-4 mt-8 border-t pt-6">
                <button type="button"
                    onclick="closeCreateModal()"
                    class="btn-secondary">
                    Cancelar
                </button>

                <button type="submit"
                    class="btn-primary">
                    Guardar
                </button>
            </div>
        </form>
    </div>
  

</div>