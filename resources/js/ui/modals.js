import { dom } from "../core/dom";
import { closeModal } from "../core/modal";

export function initModalsUI() {

    // CREATE
    document
        .getElementById("createCloseBtn")
        ?.addEventListener("click", () => closeModal(dom.createModal));

    document
        .getElementById("createCancelBtn")
        ?.addEventListener("click", () => closeModal(dom.createModal));

    // EDIT
    document
        .getElementById("closeEditModalX")
        ?.addEventListener("click", () => closeModal(dom.editModal));

    document
        .getElementById("closeEditModalBtn")
        ?.addEventListener("click", () => closeModal(dom.editModal));

    // VIEW
    document
        .getElementById("viewCloseBtn")
        ?.addEventListener("click", () => closeModal(dom.viewModal));

    document
        .getElementById("viewCancelBtn")
        ?.addEventListener("click", () => closeModal(dom.viewModal));

    // DELETE
    document
        .getElementById("cancelDeleteBtn")
        ?.addEventListener("click", () => closeModal(dom.deleteModal));
}
