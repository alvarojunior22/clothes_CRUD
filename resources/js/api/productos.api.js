const headers = {
    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
};

export async function getProductos(page = 1) {
    const res = await fetch(`/productos-data?page=${page}`);
    return res.json();
}

export async function getProducto(id) {
    const res = await fetch(`/productos-data/${id}`);
    return res.json();
}

export async function storeProducto(data) {
    return fetch("/productos-data", {
        method: "POST",
        headers,
        body: data,
    });
}

export async function updateProducto(id, data) {
    data.append("_method", "PUT");

    return fetch(`/productos-data/${id}`, {
        method: "POST",
        headers,
        body: data,
    });
}

export async function deleteProducto(id) {
    return fetch(`/productos-data/${id}`, {
        method: "DELETE",
        headers,
    });
}
