export const dom = {
    get productosBody() {
        return document.getElementById("productos-body");
    },
    get pagination() {
        return document.getElementById("pagination");
    },

    // CREATE
    get createModal() {
        return document.getElementById("createModal");
    },
    get createForm() {
        return document.getElementById("createProductoForm");
    },

    // EDIT
    get editModal() {
        return document.getElementById("productModal");
    },
    get editForm() {
        return document.getElementById("productForm");
    },
    get modalNombre() {
        return document.getElementById("modalNombre");
    },
    get modalCategoria() {
        return document.getElementById("modalCategoria");
    },
    get modalPrecio() {
        return document.getElementById("modalPrecio");
    },
    get modalStock() {
        return document.getElementById("modalStock");
    },

    // VIEW (ViewModal)
    get viewModal() {
        return document.getElementById("ViewModal");
    },
    get viewImg() {
        return document.getElementById("viewImg");
    },
    get viewImgPlaceholder() {
        return document.getElementById("viewImgPlaceholder");
    },
    get viewNombre() {
        return document.getElementById("viewNombre");
    },
    get viewCategoria() {
        return document.getElementById("viewCategoria");
    },
    get viewPrecio() {
        return document.getElementById("viewPrecio");
    },
    get viewStock() {
        return document.getElementById("viewStock");
    },

    // DELETE
    get deleteModal() {
        return document.getElementById("deleteModal");
    },
    get deleteForm() {
        return document.getElementById("deleteForm");
    },
    get deleteProductName() {
        return document.getElementById("deleteProductName");
    },
};
