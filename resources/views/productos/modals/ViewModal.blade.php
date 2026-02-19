<div id="ViewModal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

  <div
    class="bg-white w-full max-w-5xl rounded-2xl shadow-2xl
           transform transition-all scale-95 opacity-0">

    <!-- HEADER -->
    <div class="flex justify-between items-center px-8 py-5 border-b">
      <h3 class="text-xl font-semibold text-gray-900">
        Detalle del producto
      </h3>

      <button id="viewCloseBtn"
        class="text-2xl text-gray-400 hover:text-gray-600">
        &times;
      </button>
    </div>

    <!-- BODY -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-8 py-6">

      <!-- IMAGEN -->
      <div class="flex items-center justify-center">
        <div
          class="w-full h-96 rounded-xl border bg-gray-100 overflow-hidden
                 flex items-center justify-center">

          <img id="viewImg"
            class="hidden w-full h-full object-cover">

          <span id="viewImgPlaceholder"
            class="text-gray-400">
            Sin imagen
          </span>
        </div>
      </div>

      <!-- INFO -->
      <div class="space-y-5">
        <div>
          <p class="text-xs uppercase text-gray-500">Nombre</p>
          <p id="viewNombre"
            class="text-lg font-semibold text-gray-900"></p>
        </div>

        <div>
          <p class="text-xs uppercase text-gray-500">Categoría</p>
          <p id="viewCategoria"
            class="text-gray-800"></p>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <p class="text-xs uppercase text-gray-500">Precio</p>
            <p id="viewPrecio"
              class="text-gray-900 font-medium"></p>
          </div>

          <div>
            <p class="text-xs uppercase text-gray-500">Stock</p>
            <p id="viewStock"
              class="text-gray-900 font-medium"></p>
          </div>
        </div>
      </div>
    </div>

    <!-- FOOTER -->
    <div class="flex justify-end px-8 py-4 border-t bg-gray-50">
      <button id="viewCancelBtn"
        class="px-5 py-2 rounded-lg bg-gray-800 text-white hover:bg-gray-900">
        Cerrar
      </button>
    </div>
  </div>
</div>