@foreach ($cartProducts as $cartProduct)
    <div class="card my-2 px-3 py-2 rounded-1 fw-medium">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <input class="edit-check me-2 d-none check-{{ $cartProduct['product']['id'] }} pointer" type="checkbox">
                <p class="m-0 me-2 cart-quantity">{{ $cartProduct['quantity'] }}x</p>
                <p class="m-0 lh-1">{{ $cartProduct['product']['model'] }}</p>
            </div>
            <p class="m-0">${{ $cartProduct['product']['price'] * $cartProduct['quantity'] }}</p>
        </div>
    </div>
@endforeach
