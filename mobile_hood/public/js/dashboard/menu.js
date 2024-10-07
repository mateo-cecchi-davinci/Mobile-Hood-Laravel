const categories = document.getElementById("categories-btn");
const categoriesIcon = document.getElementById("categories-icon");
const categoryComponent = document.getElementById("category-component");

categories.addEventListener("click", function () {
    if (categoriesIcon.classList.contains("bx-chevron-down")) {
        categoriesIcon.classList.remove("bx-chevron-down");
        categoriesIcon.classList.add("bx-chevron-up");
        categories.classList.add("red-font");
    } else {
        categoriesIcon.classList.remove("bx-chevron-up");
        categoriesIcon.classList.add("bx-chevron-down");
        categories.classList.remove("red-font");
    }
});

document.addEventListener("click", function (event) {
    if (event.target.closest(".category")) {
        let category = event.target.closest(".category");
        fetch("/partner/dashboard/menu/category", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
            },
            body: JSON.stringify({
                category: parseInt(category.getAttribute("id")),
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data) {
                    document.getElementById("category-component").innerHTML =
                        data.data;
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    if (event.target.matches(".form-check-input")) {
        let button = event.target;
        let id = button.getAttribute("id");

        if (id.charAt(0) === "c") {
            fetch("/partner/dashboard/menu/category-state", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'input[name="_token"]',
                    ).value,
                },
                body: JSON.stringify({
                    category: parseInt(id.replace("category-", "")),
                }),
            })
                .then((response) => response.json())
                .then(() => {
                    document.getElementById("category-state").innerHTML =
                        button.checked
                            ? "Categoría activa"
                            : "Categoría inactiva";
                })
                .catch((error) => {
                    console.error(error);
                });
        } else if (id.charAt(0) === "p") {
            fetch("/partner/dashboard/menu/product-state", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'input[name="_token"]',
                    ).value,
                },
                body: JSON.stringify({
                    product: parseInt(id.replace("product-", "")),
                }),
            })
                .then((response) => response.json())
                .then(() => {
                    let amount = parseInt(
                        document
                            .getElementById("amount")
                            .innerHTML.match(/\d+/)[0],
                    );
                    amount += button.checked ? 1 : -1;
                    document.getElementById("amount").innerHTML =
                        amount + " productos activos";
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    if (event.target.matches("#add-category")) {
        fetch("/partner/dashboard/menu/add-category", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
            },
            body: JSON.stringify({
                name: document.getElementById("add-category-name").value,
                // category: document.getElementById("add-parent-category").value,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                document.getElementById("category-section").innerHTML =
                    data.data;
            })
            .catch((error) => {
                console.error(error);
            });
    }

    if (event.target.matches("#edit-category")) {
        fetch("/partner/dashboard/menu/edit-category", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
            },
            body: JSON.stringify({
                id: parseInt(
                    document.getElementById("edit-selected-category").value,
                ),
                name: document.getElementById("edit-category-name").value,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                document
                    .querySelectorAll(`#category-name-${data.id}`)
                    .forEach((element) => {
                        element.innerHTML = data.name;
                    });
            })
            .catch((error) => {
                console.error(error);
            });
    }

    if (event.target.matches("#delete-category")) {
        fetch("/partner/dashboard/menu/delete-category", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
            },
            body: JSON.stringify({
                id: parseInt(
                    document.getElementById("delete-selected-category").value,
                ),
            }),
        })
            .then((response) => response.json())
            .then(() => {
                window.location.href = "/partner/dashboard";
            })
            .catch((error) => {
                console.error(error);
            });
    }
});
