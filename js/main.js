document.addEventListener("DOMContentLoaded", () => {
    const admissionTabId = window.location.hash.slice(1) + "-tab";
    const admissionTab = document.getElementById(admissionTabId);

    if (admissionTab && window.bootstrap) {
        window.bootstrap.Tab.getOrCreateInstance(admissionTab).show();
    }

    document.querySelectorAll("form[data-demo-submit]").forEach((form) => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();

            if (!form.reportValidity()) {
                return;
            }

            form.parentElement.querySelector("[data-form-success]")?.remove();

            const alert = document.createElement("div");
            alert.className = "alert alert-success alert-dismissible fade show mb-3";
            alert.setAttribute("role", "alert");
            alert.setAttribute("data-form-success", "");

            const message = document.createElement("span");
            message.textContent =
                "Consulta validada. Esta confirmación es una simulación: el sitio no envía datos a un servidor.";

            const closeButton = document.createElement("button");
            closeButton.type = "button";
            closeButton.className = "btn-close";
            closeButton.setAttribute("data-bs-dismiss", "alert");
            closeButton.setAttribute("aria-label", "Cerrar");

            alert.append(message, closeButton);
            form.insertAdjacentElement("beforebegin", alert);
            form.reset();
        });
    });

    const newsGrid = document.getElementById("news-grid");
    const filterButtons = document.querySelectorAll("[data-news-filter]");

    if (newsGrid && filterButtons.length) {
        filterButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const selectedFilter = button.dataset.newsFilter;

                filterButtons.forEach((filterButton) => {
                    const isSelected = filterButton === button;
                    filterButton.setAttribute("aria-pressed", String(isSelected));
                    filterButton.classList.toggle("btn-dark", isSelected);
                    filterButton.classList.toggle("text-white", isSelected);
                    filterButton.classList.toggle("btn-outline-secondary", !isSelected);
                    filterButton.classList.toggle("bg-white", !isSelected);
                    filterButton.classList.toggle("border-light", !isSelected);
                    filterButton.classList.toggle("text-muted", !isSelected);
                });

                newsGrid.querySelectorAll("[data-news-category]").forEach((item) => {
                    item.classList.toggle(
                        "d-none",
                        selectedFilter !== "all" &&
                            item.dataset.newsCategory !== selectedFilter,
                    );
                });
            });
        });
    }
});
