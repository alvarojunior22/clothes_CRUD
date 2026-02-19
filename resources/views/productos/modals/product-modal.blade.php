<div id="productModal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

  <div id="productModalContent"
    class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl
                transform transition-all scale-95 opacity-0">

    <!-- HEADER -->
    <div class="flex justify-between items-center px-8 py-5 border-b">
      <h3 id="modalTitle" class="text-xl font-semibold">
        Editar Producto
      </h3>

      <button id="closeEditModalX" class="text-2xl text-gray-400">&times;</button>
    </div>

    <!-- BODY -->
    <form id="productForm" method="POST" class="px-8 py-6">
      @csrf
      <input type="hidden" name="_method" id="modalMethod" value="PUT">

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- LEFT: FORM -->
        <div class="md:col-span-2 space-y-5">

          <div>
            <label class="text-sm text-gray-500">Nombre</label>
            <input id="modalNombre" name="nombre" class="modal-input">
          </div>

          <div>
            <label class="text-sm text-gray-500">Categoría</label>
            <input id="modalCategoria" name="categoria" class="modal-input">
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="text-sm text-gray-500">Precio</label>
              <input id="modalPrecio" name="precio" type="number" class="modal-input">
            </div>

            <div>
              <label class="text-sm text-gray-500">Stock</label>
              <input id="modalStock" name="stock" type="number" class="modal-input">
            </div>
          </div>

        </div>

        <!-- RIGHT: PREVIEW -->
        <div class="flex items-center justify-center">
          <div class="w-48 h-48 rounded-xl bg-gray-100 flex items-center justify-center">
            <span class="text-gray-400 text-sm">Imagen del producto</span>
          </div>
        </div>
      </div>

      <!-- FOOTER -->
      <div class="flex justify-end gap-4 mt-8 border-t pt-6">
        <button type="button"
          id="closeEditModalBtn"
          class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
          Cancelar
        </button>

        <button id="modalSubmit"
          type="submit"
          class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
          Guardar Cambios
        </button>
      </div>
    </form>
  </div>
</div>