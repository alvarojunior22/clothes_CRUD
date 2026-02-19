<div id="deleteModal"
  class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

  <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6">

    <!-- ICON -->
    <div class="flex justify-center mb-4">
      <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
        <span class="text-red-600 text-2xl">!</span>
      </div>
    </div>

    <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">
      ¿Eliminar producto?
    </h3>

    <p class="text-sm text-gray-600 text-center mb-6">
      Esta acción <strong>no se puede deshacer</strong>.
      ¿Seguro que deseas eliminar
      <span id="deleteProductName" class="font-medium"></span>?
    </p>

    <div class="flex justify-center gap-4">
      <button
        type="button"
        id="cancelDeleteBtn"
        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300">
        Cancelar
      </button>

      <form id="deleteForm">
        @csrf
        <button
          type="submit"
          class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
          Sí, eliminar
        </button>
      </form>
    </div>
  </div>
</div>