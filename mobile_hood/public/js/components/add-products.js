document.addEventListener("partialViewLoaded", updateEvents);

function showLoader() {
    const loader = document.getElementById("loader-container");
    const video = document.getElementById("loaderVideo");

    video.currentTime = 0;
    video.play();

    loader.style.display = "flex";
}

function hideLoader() {
    const loader = document.getElementById("loader-container");
    loader.style.display = "none";
}

function hideLoaderWithDelay() {
    setTimeout(hideLoader, 1500);
}

function updateEvents() {
    const minusButtons = document.querySelectorAll(".minus-btn");
    const plusButtons = document.querySelectorAll(".plus-btn");

    minusButtons.forEach((button) => {
        button.removeEventListener("click", handleMinusClick);
        button.addEventListener("click", handleMinusClick);
    });

    plusButtons.forEach((button) => {
        button.removeEventListener("click", handlePlusClick);
        button.addEventListener("click", handlePlusClick);
    });

    document
        .querySelectorAll('form[id^="add-to-cart-form-"]')
        .forEach((form) => {
            form.removeEventListener("submit", handleFormSubmit);
            form.addEventListener("submit", handleFormSubmit);
        });
}

function handleMinusClick(event) {
    const productId = event.target.closest("button").getAttribute("data-id");
    const amountElement = document.getElementById(`amount-${productId}`);
    const amount2Element = document.getElementById(`amount2-${productId}`);
    const priceElement = document.getElementById(`price-${productId}`);
    const paymentElement = document.getElementById(`payment-${productId}`);
    const quantityElement = document.getElementById(`quantity-${productId}`);
    let amount = parseInt(amountElement.innerHTML);
    let price = parseInt(priceElement.innerHTML);
    let payment = parseInt(paymentElement.innerHTML);

    if (amount > 1) {
        amount--;

        amountElement.innerHTML = amount;
        amount2Element.innerHTML = amount;

        payment -= price;
        paymentElement.innerHTML = payment;

        quantityElement.value = amount;
    }
}

function handlePlusClick(event) {
    const productId = event.target.closest("button").getAttribute("data-id");
    const amountElement = document.getElementById(`amount-${productId}`);
    const amount2Element = document.getElementById(`amount2-${productId}`);
    const priceElement = document.getElementById(`price-${productId}`);
    const paymentElement = document.getElementById(`payment-${productId}`);
    const quantityElement = document.getElementById(`quantity-${productId}`);
    let amount = parseInt(amountElement.innerHTML);
    let price = parseInt(priceElement.innerHTML);
    let payment = parseInt(paymentElement.innerHTML);

    amount++;

    amountElement.innerHTML = amount;
    amount2Element.innerHTML = amount;

    payment += price;
    paymentElement.innerHTML = payment;

    quantityElement.value = amount;
}

function handleFormSubmit(event) {
    event.preventDefault();

    const userId = this.querySelector('input[name="user"]').value;

    if (!userId) {
        window.location.href = "/login";
        return;
    }

    const businessId = this.querySelector('input[name="business"]').value;
    const productId = this.getAttribute("data-product-id");
    const quantity = this.querySelector('input[name="quantity"]').value;
    const productsByCategory = JSON.parse(
        this.querySelector('input[name="productsByCategory"]').value,
    );
    const cartProducts = JSON.parse(
        this.querySelector('input[name="cartProducts"]').value,
    );

    showLoader();

    fetch("/add-products", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": this.querySelector('input[name="_token"]').value,
        },
        body: JSON.stringify({
            user: userId,
            business: businessId,
            product: productId,
            quantity: quantity,
            productsByCategory: productsByCategory,
            cartProducts: cartProducts,
        }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            hideLoaderWithDelay();
            document.getElementById("products-list").innerHTML = data.products;
            document.getElementById("cart").innerHTML = data.cart;
            document.dispatchEvent(new Event("partialViewLoaded"));
        })
        .catch((error) => {
            console.error("Error:", error);
            hideLoaderWithDelay();
        });
}

updateEvents();
