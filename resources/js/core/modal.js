export function openModal(modal) {
    if (!modal) {
        console.error("openModal: modal es null");
        return;
    }

    modal.classList.remove("hidden");

    const content = modal.firstElementChild;
    if (content) {
        content.classList.remove("scale-95", "opacity-0");
    }
}

export function closeModal(modal) {
    if (!modal) return;

    const content = modal.firstElementChild;
    if (content) {
        content.classList.add("scale-95", "opacity-0");
    }

    setTimeout(() => {
        modal.classList.add("hidden");
    }, 200);
}
