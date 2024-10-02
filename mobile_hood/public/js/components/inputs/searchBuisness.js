let debounceTimer;

function debounce(func, delay) {
    return function (...args) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}

function filterBuisnesses() {
    let query = document.getElementById("searchInput").value;

    fetch(`/filter-buisnesses?query=${query}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("buisnesses").innerHTML = html;
            document.dispatchEvent(new Event("partialViewLoaded"));
        })
        .catch((error) => console.error("Error al filtrar productos:", error));
}

const debouncedfilterBuisnesses = debounce(filterBuisnesses, 250);

document.getElementById("searchInput").addEventListener("input", function () {
    debouncedfilterBuisnesses();
});

document
    .getElementById("searchInput")
    .addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });
