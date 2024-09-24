let debounceTimer;

function debounce(func, delay) {
    return function (...args) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}

function filterProducts() {
    let query = document.getElementById("searchInput").value;
    let buisnessId = document.getElementById("buisnessId").value;

    if (query.trim() === "") {
        document.getElementById("products-list").innerHTML = "";
        return;
    }

    fetch(`/filter-products?query=${query}&buisness=${buisnessId}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("products-list").innerHTML = html;
            document.dispatchEvent(new Event("partialViewLoaded"));
        })
        .catch((error) => console.error("Error al filtrar productos:", error));
}

const debouncedFilterProducts = debounce(filterProducts, 500);

document.getElementById("searchInput").addEventListener("input", function () {
    debouncedFilterProducts();
});

document
    .getElementById("searchInput")
    .addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();

            const query = document.getElementById("searchInput").value.trim();
            const buisnessId = document.getElementById("buisnessId").value;

            if (query === "") {
                fetch(`/filter-products?query=&buisness=${buisnessId}`, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                    .then((response) => response.text())
                    .then((html) => {
                        document.getElementById("products-list").innerHTML =
                            html;
                        document.dispatchEvent(new Event("partialViewLoaded"));
                    })
                    .catch((error) =>
                        console.error("Error filtering products:", error),
                    );
            } else {
                debouncedFilterProducts();
            }
        }
    });
