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
    let buisnessId = document.getElementById("buisnessId").value;
    let query = "";

    document.querySelectorAll(".search-input").forEach((input) => {
        if (input.value != "") {
            query = input.value;
        }
    });

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

document.querySelectorAll(".search-input").forEach((input) => {
    input.addEventListener("input", () => debouncedFilterProducts());
});

document.querySelectorAll(".search-input").forEach((input) => {
    input.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });
});
