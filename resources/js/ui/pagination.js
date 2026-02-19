import { dom } from "../core/dom";

export function renderPagination(data, onPageChange) {
    const { current_page, last_page } = data;
    dom.pagination.innerHTML = "";

    const fragment = document.createDocumentFragment();

    function createButton(label, page, { disabled = false, active = false } = {}) {
        const btn = document.createElement("button");
        btn.textContent = label;
        btn.disabled = disabled;

        btn.className = `
            px-3 py-1.5 text-sm font-medium rounded-md
            transition-colors duration-200
            ${active 
                ? "bg-blue-600 text-white shadow-sm" 
                : "bg-white text-gray-700 border border-gray-300 hover:bg-gray-100"}
            ${disabled ? "opacity-40 cursor-not-allowed hover:bg-white" : ""}
        `;

        btn.onclick = () => {
            if (!disabled) onPageChange(page);
        };

        return btn;
    }

    // Contenedor flex
    const container = document.createElement("div");
    container.className = "flex items-center justify-center gap-2 flex-wrap";

    // Botón Anterior
    container.appendChild(
        createButton("‹", current_page - 1, {
            disabled: current_page === 1
        })
    );

    const range = 2;
    const start = Math.max(1, current_page - range);
    const end = Math.min(last_page, current_page + range);

    if (start > 1) {
        container.appendChild(createButton(1, 1));
        if (start > 2) {
            container.appendChild(createDots());
        }
    }

    for (let i = start; i <= end; i++) {
        container.appendChild(
            createButton(i, i, {
                active: i === current_page
            })
        );
    }

    if (end < last_page) {
        if (end < last_page - 1) {
            container.appendChild(createDots());
        }
        container.appendChild(createButton(last_page, last_page));
    }

    // Botón Siguiente
    container.appendChild(
        createButton("›", current_page + 1, {
            disabled: current_page === last_page
        })
    );

    fragment.appendChild(container);
    dom.pagination.appendChild(fragment);

    function createDots() {
        const span = document.createElement("span");
        span.textContent = "...";
        span.className = "px-2 text-gray-400 text-sm";
        return span;
    }
}
