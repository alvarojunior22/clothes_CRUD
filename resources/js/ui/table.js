import { dom } from "../core/dom";
import {
    openEditModal,
    openViewModal,
    openDeleteModal,
} from "../features/productos";

/**
 * Renderiza la tabla completa de productos
 */
export function renderProductosTable(productos) {
    dom.productosBody.innerHTML = "";

    productos.forEach((p) => {
        const tr = document.createElement("tr");

        const imagen = p.imagen
            ? `<img src="/storage/${p.imagen}"
                    class="w-12 h-12 rounded-lg object-cover mx-auto border">`
            : `<div class="w-12 h-12 flex items-center justify-center
                    rounded-lg bg-gray-100 text-gray-400 text-xs mx-auto">—</div>`;

        tr.innerHTML = `
            <td class="px-6 py-4 text-center">${imagen}</td>
            <td class="px-6 py-4 font-medium text-gray-900">${p.nombre}</td>
            <td class="px-6 py-4">${p.categoria?.nombre ?? "-"}</td>
            <td class="px-6 py-4">$${Number(p.precio).toFixed(2)}</td>
            <td class="px-6 py-4">${p.stock}</td>
            <td class="px-6 py-4 text-right space-x-2">
                <button
                    class="btn-edit px-3 py-1.5 text-xs bg-blue-600 text-white rounded"
                    data-id="${p.id}">
                    Editar
                </button>

                <button
                    class="btn-view px-3 py-1.5 text-xs bg-gray-800 text-white rounded"
                    data-id="${p.id}">
                    Ver
                </button>

                <button
                    class="btn-delete px-3 py-1.5 text-xs bg-red-600 text-white rounded"
                    data-id="${p.id}">
                    Eliminar
                </button>
            </td>
        `;

        dom.productosBody.appendChild(tr);
    });

    bindTableActions(productos);
}

/**
 * Conecta los botones de la tabla con las funciones del feature
 */
function bindTableActions(productos) {
    dom.productosBody.querySelectorAll(".btn-edit").forEach((btn) => {
        btn.addEventListener("click", () => {
            openEditModal(btn.dataset.id);
        });
    });

    dom.productosBody.querySelectorAll(".btn-view").forEach((btn) => {
        btn.addEventListener("click", () => {
            const producto = productos.find((p) => p.id == btn.dataset.id);
            openViewModal(producto);
        });
    });

    dom.productosBody.querySelectorAll(".btn-delete").forEach((btn) => {
        btn.addEventListener("click", () => {
            const producto = productos.find((p) => p.id == btn.dataset.id);
            openDeleteModal(producto);
        });
    });
}
