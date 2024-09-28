document.addEventListener("partialViewLoaded", function () {
    assignEditBehavior();
});

document.addEventListener("updateCartEvents", assignEditBehavior);

let products = [];

function assignEditBehavior() {
    document.querySelectorAll(".edit-cart").forEach((button) => {
        button.removeEventListener("click", () => handleEdit(button));
        button.addEventListener("click", () => handleEdit(button));
    });

    document.querySelectorAll(".edit-check").forEach((checkbox) => {
        checkbox.addEventListener("change", handleCheckboxChange);
    });

    //const continueForm = document.getElementById("continue");
    //continueForm?.removeEventListener("submit", deleteSelectedProducts);
    //continueForm?.addEventListener("submit", deleteSelectedProducts);

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
    document.querySelectorAll(".cart-quantity").forEach((quantity) => {
        quantity.classList.toggle("d-none");
    });

    document.querySelectorAll(".edit-check").forEach((checkbox) => {
        checkbox.classList.toggle("d-none");
    });
}

function handleCheckboxChange(event) {
    const productId = event.target.classList[2].split("-")[1];
    if (event.target.checked) {
        if (!products.includes(productId)) {
            products.push(productId);
        }
    } else {
        products = products.filter((id) => id !== productId);
    }
}

function deleteSelectedProducts(event) {
    event.preventDefault();

    const userId = this.querySelector('input[name="user"]').value;

    if (!userId) {
        window.location.href = "/login";
        return;
    }

    const buisness = this.querySelector('input[name="buisness"]').value;
    const cartProducts = JSON.parse(
        this.querySelector('input[name="cartProducts"]').value,
    );

    console.log(products);

    fetch("/delete-cart-products", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": this.querySelector('input[name="_token"]').value,
        },
        body: JSON.stringify({
            user: userId,
            buisness: buisness,
            cartProducts: cartProducts,
            products: products,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            products = [];
            document.getElementById("cart").innerHTML = data.cart;
            document.dispatchEvent(new Event("updateCartEvents"));
        })
        .catch((error) => {
            console.error("Error al eliminar productos:", error);
        });
}

assignEditBehavior();
