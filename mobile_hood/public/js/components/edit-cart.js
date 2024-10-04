document.addEventListener("partialViewLoaded", function () {
    assignEditBehavior();
});

document.addEventListener("updateCartEvents", assignEditBehavior);

let products = [];
let check = [];

function assignEditBehavior() {
    document.querySelectorAll(".edit-cart").forEach((button) => {
        button.removeEventListener("click", () => handleEdit(button));
        button.addEventListener("click", () => handleEdit(button));
    });

    document.querySelectorAll(".edit-check").forEach((checkbox) => {
        checkbox.addEventListener("change", handleCheckboxChange);
    });

    document.querySelectorAll(".delete").forEach((form) => {
        form.removeEventListener("submit", deleteSelectedProducts);
        form.addEventListener("submit", deleteSelectedProducts);
    });

    function handleEdit(button) {
        toggleButtonText(button);
        toggleEditMode();
    }

    function toggleButtonText(button) {
        button.textContent =
            button.textContent === "Editar" ? "Aceptar" : "Editar";
    }
}

function toggleEditMode() {
    const quantities = document.querySelectorAll(".cart-quantity");
    const checkboxes = document.querySelectorAll(".edit-check");

    quantities.forEach((quantity, index) => {
        const checkbox = checkboxes[index];
        quantity.classList.toggle("d-none");
        checkbox.classList.toggle("d-none");
    });
}

function handleCheckboxChange(event) {
    const productId = event.target.classList[2].split("-")[1];
    const checkboxes = document.querySelectorAll(".edit-check");
    const continueBtns = document.querySelectorAll(".continue-btn");
    const deleteBtns = document.querySelectorAll(".delete-btn");
    const anyChecked = Array.from(checkboxes).some(
        (checkbox) => checkbox.checked,
    );

    if (event.target.checked) {
        if (!products.includes(productId)) {
            products.push(productId);
        }
    } else {
        products = products.filter((id) => id !== productId);
    }

    if (anyChecked) {
        continueBtns.forEach((button) => {
            button.classList.add("d-none");
        });

        deleteBtns.forEach((button) => {
            button.classList.remove("d-none");
        });
    } else {
        continueBtns.forEach((button) => {
            button.classList.remove("d-none");
        });

        deleteBtns.forEach((button) => {
            button.classList.add("d-none");
        });
    }
}

function deleteSelectedProducts(event) {
    event.preventDefault();

    const userId = this.querySelector('input[name="user"]').value;

    if (!userId) {
        window.location.href = "/login";
        return;
    }

    const business = this.querySelector('input[name="business"]').value;
    const cartProducts = JSON.parse(
        this.querySelector('input[name="cartProducts"]').value,
    );

    fetch("/delete-cart-products", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": this.querySelector('input[name="_token"]').value,
        },
        body: JSON.stringify({
            user: userId,
            business: business,
            cartProducts: cartProducts,
            products: products,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            products = [];
            check = [];
            document.getElementById("cart").innerHTML = data.cart;
            document.dispatchEvent(new Event("updateCartEvents"));
        })
        .catch((error) => {
            console.error("Error al eliminar productos:", error);
        });
}

assignEditBehavior();
