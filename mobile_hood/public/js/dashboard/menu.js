const categories = document.getElementById("categories-btn");
const categoriesIcon = document.getElementById("categories-icon");
const categoryComponent = document.getElementById("category-component");

document.querySelectorAll(".category").forEach((category) => {
    category.addEventListener("click", () => {
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
    });
});

document.addEventListener("click", function (event) {
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
});

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
