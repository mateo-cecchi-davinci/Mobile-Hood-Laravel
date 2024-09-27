document.addEventListener("updateCartEvents", assignEditBehavior);

let products = [];

function assignEditBehavior() {
    const editCartLarge = document.getElementById("edit-cart");
    const editCartModal = document.getElementById("edit-cart-modal");
    const continueForm = document.getElementById("continue");
    const deleteForm = document.getElementById("delete");

    editCartLarge?.removeEventListener("click", handleEdit);
    editCartModal?.removeEventListener("click", handleModalEdit);
    editCartLarge?.addEventListener("click", handleEdit);
    editCartModal?.addEventListener("click", handleModalEdit);

    continueForm?.removeEventListener("submit", deleteSelectedProducts);
    deleteForm?.removeEventListener("submit", deleteSelectedProducts);
    continueForm?.addEventListener("submit", deleteSelectedProducts);
    deleteForm?.addEventListener("submit", deleteSelectedProducts);

    document
        .querySelectorAll(".edit-check, .edit-check-modal")
        .forEach((checkbox) => {
            checkbox.addEventListener("change", handleCheckboxChange);
        });

    function handleEdit() {
        toggleButtonText(editCartLarge);
        toggleEditMode("large");
    }

    function handleModalEdit() {
        toggleButtonText(editCartModal);
        toggleEditMode("modal");
    }

    function toggleButtonText(button) {
        button.textContent === "Editar" ? "Aceptar" : "Editar";
    }
}

function toggleEditMode(type) {
    const quantities = document.querySelectorAll(
        type === "large" ? ".cart-quantity" : ".cart-quantity-modal",
    );

    quantities.forEach((quantity) => {
        quantity.classList.toggle("d-none");
    });

    const checkboxes = document.querySelectorAll(
        type === "large" ? ".edit-check" : ".edit-check-modal",
    );

    checkboxes.forEach((checkbox) => {
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
            document.getElementById("cart").innerHTML = data.cart;
            document.dispatchEvent(new Event("updateCartEvents"));
        })
        .catch((error) => {
            console.error("Error al eliminar productos:", error);
        });
}

assignEditBehavior();
