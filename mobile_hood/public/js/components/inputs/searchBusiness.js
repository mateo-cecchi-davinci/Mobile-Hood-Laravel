let debounceTimer;

function debounce(func, delay) {
    return function (...args) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}

function filterBusinesses() {
    let query = document.getElementById("searchInput").value;

    fetch(`/filter-businesses?query=${query}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("businesses").innerHTML = html;
            document.dispatchEvent(new Event("partialViewLoaded"));
        })
        .catch((error) => console.error("Error al filtrar productos:", error));
}

const debouncedfilterBusinesses = debounce(filterBusinesses, 250);

document.getElementById("searchInput").addEventListener("input", function () {
    debouncedfilterBusinesses();
});

document
    .getElementById("searchInput")
    .addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });
