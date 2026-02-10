document.addEventListener("DOMContentLoaded", async () => {
    const app = document.getElementById("app");

    const USER_ID = app.dataset.userId;
    const IS_ADMIN = app.dataset.isAdmin === "true";

    const productosBody = document.getElementById("productos-body");

    /** ========================
     * MODALES
     * ======================== */
    const createModal = document.getElementById("createModal");
    const createForm = document.getElementById("createProductoForm");

    const productModal = document.getElementById("productModal");
    const productForm = document.getElementById("productForm");
    const modalTitle = document.getElementById("modalTitle");
    const modalSubmit = document.getElementById("modalSubmit");
    const modalMethod = document.getElementById("modalMethod");

    const deleteModal = document.getElementById("deleteModal");
    const deleteForm = document.getElementById("deleteForm");
    const deleteProductName = document.getElementById("deleteProductName");

    /** ========================
     * FUNCIONES MODALES
     * ======================== */
    function toggleModal(modal, open) {
        if (open) {
            modal.classList.remove("hidden");
            setTimeout(() => modal.classList.remove("scale-95", "opacity-0"), 10);
        } else {
            modal.classList.add("scale-95", "opacity-0");
            setTimeout(() => modal.classList.add("hidden"), 200);
        }
    }

    window.openCreateModal = () => toggleModal(createModal, true);
    window.closeCreateModal = () => toggleModal(createModal, false);
    window.closeProductModal = () => toggleModal(productModal, false);
    window.closeDeleteConfirm = () => toggleModal(deleteModal, false);

    /** ========================
     * CARGAR PRODUCTOS AL INICIO
     * ======================== */
    async function loadProductos() {
        try {
            const res = await fetch("/api/productos", {
                headers: { "Accept": "application/json" }
            });
            const data = await res.json();
            productosBody.innerHTML = "";
            data.forEach(addProductoToTable);
        } catch (err) {
            console.error(err);
            alert("Error al cargar productos");
        }
    }

    await loadProductos();

    /** ========================
     * CREAR PRODUCTO
     * ======================== */
    createForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(createForm);

        try {
            const res = await fetch("/api/productos", {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            const data = await res.json();
            if (!res.ok) throw data;

            addProductoToTable(data);
            closeCreateModal();
            createForm.reset();
            alert("Producto creado!");
        } catch (err) {
            console.error(err);
            alert("Error al crear producto");
        }
    });

    /** ========================
     * EDITAR / VER PRODUCTO
     * ======================== */
    window.openEdit = async (id) => {
        try {
            const res = await fetch(`/api/productos/${id}`, {
                headers: { "Accept": "application/json" }
            });
            const p = await res.json();

            productForm.dataset.id = p.id;
            document.getElementById("modalNombre").value = p.nombre;
            document.getElementById("modalCategoria").value = p.categoria;
            document.getElementById("modalPrecio").value = p.precio;
            document.getElementById("modalStock").value = p.stock;

            modalTitle.innerText = "Editar Producto";
            modalSubmit.innerText = "Guardar Cambios";
            modalSubmit.classList.remove("hidden");
            modalMethod.value = "PUT";

            toggleModal(productModal, true);
        } catch (err) {
            console.error(err);
            alert("Error al cargar producto");
        }
    };

    window.openView = (p) => {
        document.getElementById("modalNombre").value = p.nombre;
        document.getElementById("modalCategoria").value = p.categoria;
        document.getElementById("modalPrecio").value = p.precio;
        document.getElementById("modalStock").value = p.stock;

        modalTitle.innerText = "Detalle del Producto";
        modalSubmit.classList.add("hidden");

        toggleModal(productModal, true);
    };

    productForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const id = productForm.dataset.id;
        const formData = new FormData(productForm);
        formData.append("_method", "PUT");

        try {
            const res = await fetch(`/api/productos/${id}`, {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            const data = await res.json();
            if (!res.ok) throw data;

            updateProductoInTable(data);
            closeProductModal();
            alert("Producto actualizado!");
        } catch (err) {
            console.error(err);
            alert("Error al actualizar producto");
        }
    });

    /** ========================
     * ELIMINAR PRODUCTO
     * ======================== */
    window.openDeleteConfirm = (producto) => {
        deleteProductName.textContent = producto.nombre;
        deleteForm.dataset.id = producto.id;
        toggleModal(deleteModal, true);
    };

    deleteForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const id = deleteForm.dataset.id;

        try {
            const res = await fetch(`/api/productos/${id}`, {
                method: "DELETE",
                headers: {
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!res.ok) throw await res.json();

            removeProductoFromTable(id);
            closeDeleteConfirm();
            alert("Producto eliminado!");
        } catch (err) {
            console.error(err);
            alert("Error al eliminar producto");
        }
    });

    /** ========================
     * TABLA DINÁMICA
     * ======================== */
    function addProductoToTable(p) {
        const tr = document.createElement("tr");
        tr.id = `producto-${p.id}`;

        // Estado de stock
        let estado = "";
        if (p.stock > 20) estado = `<span class="badge-green">Disponible</span>`;
        else if (p.stock > 0) estado = `<span class="badge-yellow">Bajo stock</span>`;
        else estado = `<span class="badge-red">Sin stock</span>`;

        tr.innerHTML = `
            <td class="p-4 font-medium">${p.nombre}</td>
            <td class="p-4">${p.categoria}</td>
            <td class="p-4">$${p.precio.toFixed(2)}</td>
            <td class="p-4">${p.stock}</td>
            <td class="p-4">${estado}</td>
            <td class="p-4 text-right space-x-2">
                <button onclick="openEdit(${p.id})" class="text-blue-600">Editar</button>
                <button onclick="openView(${JSON.stringify(p)})" class="text-gray-600">Ver</button>
                <button onclick='openDeleteConfirm(${JSON.stringify(p)})' class="text-red-600">Eliminar</button>
            </td>
        `;
        productosBody.appendChild(tr);
    }

    function updateProductoInTable(p) {
        const row = document.getElementById(`producto-${p.id}`);
        if (!row) return;
        row.remove();
        addProductoToTable(p);
    }

    function removeProductoFromTable(id) {
        const row = document.getElementById(`producto-${id}`);
        if (row) row.remove();
    }

});
