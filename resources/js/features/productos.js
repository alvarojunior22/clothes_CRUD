// API
import {
    getProductos,
    getProducto,
    storeProducto,
    updateProducto,
    deleteProducto,
} from "../api/productos.api";

// CORE
import { dom } from "../core/dom";
import { openModal, closeModal } from "../core/modal";

// UI
import { renderProductosTable } from "../ui/table";
import { renderPagination } from "../ui/pagination";
import { initModalsUI } from "../ui/modals";
import { data } from "autoprefixer";

let currentPage = 1;

/**
 *  INICIALIZADOR PRINCIPAL
 * Se llama SOLO una vez desde app.js
 */
export function initProductos() {
    initModalsUI();
    initCreateForm();
    initDeleteForm();
    initEditForm();
    loadProductos(1);

      document
          .getElementById("openCreateBtn")
          ?.addEventListener("click", openCreateModal);

      loadProductos(1);
}

/**
 *  CARGAR PRODUCTOS (PAGINADO)
 */
export async function loadProductos(page = 1) {
    currentPage = page;

    const data = await getProductos(page);

    // data.data = productos
    renderProductosTable(data.data);

    // paginación
    renderPagination(data, loadProductos);
}

/**
 * ABRIR MODAL CREAR
 */

function openCreateModal() {
    dom.createForm.reset();

    // limpiar preview
    const previewImg = document.getElementById("previewImg");
    const placeholder = document.getElementById("imagePlaceholder");

    if (previewImg) {
        previewImg.src = "";
        previewImg.classList.add("hidden");
    }
    if (placeholder) {
        placeholder.classList.remove("hidden");
    }

    openModal(dom.createModal);
}

 


/**
 * SUBMIT CREAR
 */

function initCreateForm() {
    if (!dom.createForm) return;

    dom.createForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(dom.createForm);

        const res = await storeProducto(formData);

        if (res.ok) {
            alert('producto creado con exito')
        } else {
            new Error('error al crear el producto')
            
        }
        

        closeModal(dom.createModal);
        loadProductos(1);
    });
}
/**
 * ABRIR MODAL EDITAR
 */
export async function openEditModal(id) {
    const p = await getProducto(id);

    dom.editForm.dataset.id = p.id;
    dom.modalNombre.value = p.nombre;
    dom.modalCategoria.value = p.categoria_id;
    dom.modalPrecio.value = p.precio;
    dom.modalStock.value = p.stock;

    openModal(dom.editModal);
}

/**
 * SUBMIT EDITAR
 */
function initEditForm() {
    if (!dom.editForm) return;

    dom.editForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const id = dom.editForm.dataset.id;
        const formData = new FormData(dom.editForm);

        await updateProducto(id, formData);

        closeModal(dom.editModal);
        loadProductos(currentPage);
    });
}

/**
 * ABRIR MODAL VER
 */
export function openViewModal(producto) {
    dom.viewNombre.textContent = producto.nombre;
    dom.viewCategoria.textContent = producto.categoria?.nombre ?? "—";
    dom.viewPrecio.textContent = `$${Number(producto.precio).toFixed(2)}`;
    dom.viewStock.textContent = producto.stock;

    if (producto.imagen) {
        dom.viewImg.src = `/storage/${producto.imagen}`;
        dom.viewImg.classList.remove("hidden");
        dom.viewImgPlaceholder.classList.add("hidden");
    } else {
        dom.viewImg.classList.add("hidden");
        dom.viewImgPlaceholder.classList.remove("hidden");
    }

    openModal(dom.viewModal);
}

/**
 *  ABRIR MODAL ELIMINAR
 */
export function openDeleteModal(producto) {
    dom.deleteProductName.textContent = producto.nombre;
    dom.deleteForm.dataset.id = producto.id;

    openModal(dom.deleteModal);
}

/**
 * SUBMIT ELIMINAR
 */
function initDeleteForm() {
    if (!dom.deleteForm) return;

    dom.deleteForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const id = dom.deleteForm.dataset.id;

        await deleteProducto(id);

        closeModal(dom.deleteModal);
        loadProductos(currentPage);
    });
}
