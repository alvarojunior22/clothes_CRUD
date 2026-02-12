document.addEventListener("DOMContentLoaded", async () => {
    const app = document.getElementById("app");

    const USER_ID = app.dataset.userId;
    const IS_ADMIN = app.dataset.isAdmin === "true";

    const productosBody = document.getElementById("productos-body");
    const paginationContainer = document.getElementById("pagination");

    let currentPage = 1;

    /** ========================
     * MODALES
     * ======================== */
    const createModal = document.getElementById("createModal");
    const createForm = document.getElementById("createProductoForm");

    const productModal = document.getElementById("productModal");
    const productForm = document.getElementById("productForm");
    const modalTitle = document.getElementById("modalTitle");
    const modalSubmit = document.getElementById("modalSubmit");

    const deleteModal = document.getElementById("deleteModal");
    const deleteForm = document.getElementById("deleteForm");
    const deleteProductName = document.getElementById("deleteProductName");

    /** ========================
     * HELPERS MODALES
     * ======================== */
    function openModal(modal) {
        modal.classList.remove("hidden");
        setTimeout(() => modal.classList.remove("scale-95", "opacity-0"), 10);
    }

    function closeModal(modal) {
        modal.classList.add("scale-95", "opacity-0");
        setTimeout(() => modal.classList.add("hidden"), 200);
    }

    window.openCreateModal = () => openModal(createModal);
    window.closeCreateModal = () => {
        createForm.reset();
        closeModal(createModal);
    };

    window.closeProductModal = () => {
        productForm.reset();
        delete productForm.dataset.id;
        closeModal(productModal);
    };

    window.closeDeleteConfirm = () => closeModal(deleteModal);

    /** ========================
     * CARGAR PRODUCTOS (PAGINADO)
     * ======================== */
    async function loadProductos(page = 1) {
        currentPage = page;

        try {
            const res = await fetch(`/productos-data?page=${page}`, {
                headers: { Accept: "application/json" },
            });

            const data = await res.json();

            productosBody.innerHTML = "";

            data.data.forEach(addProductoToTable);

            renderPagination(data);
        } catch (err) {
            console.error(err);
            alert("Error al cargar productos");
        }
    }

    /** ========================
     * PAGINACIÓN PROFESIONAL
     * ======================== */
    function renderPagination(pagination) {
        paginationContainer.innerHTML = "";

        // ⬅️ Anterior
        if (pagination.current_page > 1) {
            paginationContainer.appendChild(
                createPageButton("«", pagination.current_page - 1),
            );
        }

        // 🔢 Páginas
        for (let i = 1; i <= pagination.last_page; i++) {
            const btn = createPageButton(i, i);

            if (i === pagination.current_page) {
                btn.classList.add("bg-blue-600", "text-white");
            }

            paginationContainer.appendChild(btn);
        }

        // ➡️ Siguiente
        if (pagination.current_page < pagination.last_page) {
            paginationContainer.appendChild(
                createPageButton("»", pagination.current_page + 1),
            );
        }
    }

    function createPageButton(text, page) {
        const btn = document.createElement("button");
        btn.textContent = text;
        btn.className = "px-3 py-1 border rounded hover:bg-gray-200 transition";
        btn.onclick = () => loadProductos(page);
        return btn;
    }

    await loadProductos(1);

    /** ========================
     * CREAR PRODUCTO
     * ======================== */
    createForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        try {
            const formData = new FormData(createForm);

            const res = await fetch("/productos-data", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                },
                body: formData,
            });

            const data = await res.json();
            if (!res.ok) throw data;

            await loadProductos(currentPage);
            closeCreateModal();
            alert("Producto creado!");
        } catch (err) {
            console.error(err);
            alert("Error al crear producto");
        }
    });

    /** ========================
     * EDITAR PRODUCTO
     * ======================== */
    window.openEdit = async (id) => {
        try {
            const res = await fetch(`/productos-data/${id}`, {
                headers: { Accept: "application/json" },
            });

            const p = await res.json();

            productForm.reset();
            productForm.dataset.id = p.id;

            modalNombre.value = p.nombre;
            modalCategoria.value = p.categoria_id;
            modalPrecio.value = p.precio;
            modalStock.value = p.stock;

            modalTitle.innerText = "Editar Producto";
            modalSubmit.innerText = "Guardar cambios";
            modalSubmit.classList.remove("hidden");

            openModal(productModal);
        } catch (err) {
            console.error(err);
            alert("Error al cargar producto");
        }
    };

    /** ========================
     * VER PRODUCTO
     * ======================== */
    window.openView = (p) => {
        productForm.reset();

        modalNombre.value = p.nombre;
        modalCategoria.value = p.categoria?.nombre;
        modalPrecio.value = p.precio;
        modalStock.value = p.stock;

        modalTitle.innerText = "Detalle del Producto";
        modalSubmit.classList.add("hidden");

        openModal(productModal);
    };

    /** ========================
     * ACTUALIZAR PRODUCTO
     * ======================== */
    productForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const id = productForm.dataset.id;
        if (!id) return;

        modalSubmit.disabled = true;
        modalSubmit.innerText = "Guardando...";

        try {
            const formData = new FormData(productForm);
            formData.append("_method", "PUT");

            const res = await fetch(`/productos-data/${id}`, {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                },
                body: formData,
            });

            const data = await res.json();
            if (!res.ok) throw data;

            await loadProductos(currentPage);
            closeProductModal();
            alert("Producto actualizado!");
        } catch (err) {
            console.error(err);
            alert("Error al actualizar producto");
        } finally {
            modalSubmit.disabled = false;
            modalSubmit.innerText = "Guardar cambios";
        }
    });

    /** ========================
     * ELIMINAR PRODUCTO
     * ======================== */
    window.openDeleteConfirm = (producto) => {
        deleteProductName.textContent = producto.nombre;
        deleteForm.dataset.id = producto.id;
        openModal(deleteModal);
    };

    deleteForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const id = deleteForm.dataset.id;

        try {
            const res = await fetch(`/productos-data/${id}`, {
                method: "DELETE",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                },
            });

            if (!res.ok) throw await res.json();

            await loadProductos(currentPage);
            closeDeleteConfirm();
            alert("Producto eliminado!");
        } catch (err) {
            console.error(err);
            alert("Error al eliminar producto");
        }
    });

    /** ========================
     * TABLA
     * ======================== */
    function addProductoToTable(p) {
        const tr = document.createElement("tr");
        tr.id = `producto-${p.id}`;

        let estado = "";
        if (p.stock > 20)
            estado = `<span class="badge-green">Disponible</span>`;
        else if (p.stock > 0)
            estado = `<span class="badge-yellow">Bajo stock</span>`;
        else estado = `<span class="badge-red">Sin stock</span>`;

        tr.innerHTML = `
            <td class="p-4 font-medium">${p.nombre}</td>
            <td class="p-4">${p.categoria?.nombre ?? "-"}</td>
            <td class="p-4">$${Number(p.precio).toFixed(2)}</td>
            <td class="p-4">${p.stock}</td>
            <td class="p-4">${estado}</td>
            <td class="p-4 text-right space-x-2">
                <button onclick="openEdit(${p.id})"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Editar
                </button>
                <button onclick='openView(${JSON.stringify(p)})'
                    class="px-4 py-2 text-sm text-white bg-gray-800 rounded-lg">
                    Ver
                </button>
                <button onclick='openDeleteConfirm(${JSON.stringify(p)})'
                    class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Eliminar
                </button>
            </td>
        `;

        productosBody.appendChild(tr);
    }
});
