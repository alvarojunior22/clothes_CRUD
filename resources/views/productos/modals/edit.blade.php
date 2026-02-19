<div id="productModal"
    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

    <div id="productModalContent"
        class="bg-white text-gray-800 w-full max-w-4xl rounded-2xl shadow-2xl p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-800">
                Editar Producto
            </h3>

            <button id="closeEditModalX"
                class=" text-gray-400 hover:text-gray-600 text-2xl">
                &times;
            </button>
        </div>

        <!-- BODY -->
        <form id="productForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="modalMethod">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- FORM -->
                <div class="md:col-span-2 space-y-5">

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Nombre
                        </label>
                        <input id="modalNombre" name="nombre"
                            class="modal-input text-gray-800 bg-gray-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Categoría
                        </label>
                        <input id="modalCategoria" name="categoria"
                            class="modal-input text-gray-800 bg-gray-100">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">
                                Precio
                            </label>
                            <input id="modalPrecio" name="precio" type="number"
                                class="modal-input text-gray-800 bg-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">
                                Stock
                            </label>
                            <input id="modalStock" name="stock" type="number"
                                class="modal-input text-gray-800 bg-gray-100">
                        </div>
                    </div>
                </div>

                <!-- PREVIEW -->
                <div class="flex items-center justify-center">
                    <div class="w-48 h-48 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">
                        Imagen
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-4 mt-8 border-t pt-6">
                <button type="button"
                    id="closeEditModalBtn"
                    class="btn-secondary">
                    Cancelar
                </button>

                <button id="modalSubmit"
                    type="submit"
                    class="btn-primary">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>