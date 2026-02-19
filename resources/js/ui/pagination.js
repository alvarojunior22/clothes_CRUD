import { dom } from "../core/dom";

export function renderPagination(data, onPageChange) {
    dom.pagination.innerHTML = "";

    for (let i = 1; i <= data.last_page; i++) {
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.onclick = () => onPageChange(i);
        dom.pagination.appendChild(btn);
    }
}
