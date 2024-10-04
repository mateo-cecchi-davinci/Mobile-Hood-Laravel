@if (session('toast'))
    <div id="noResultsToast" class="bg-primary border-0 rounded-1 py-3 ps-4 pe-3 text-light toast-msg shadow">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center pe-3">
                <i class="bx bxs-info-circle my-auto me-3 lg-icon"></i>
                <p class="fw-semibold m-0 lh-sm">No encontramos "{{ $query }}" en el menú</p>
            </div>
            <i id="close-icon" class="bx bx-x close-icon"></i>
        </div>
    </div>
    {{ session()->forget('toast') }}
@endif

@foreach ($productsByCategory as $category_name => $products)
    <div class="row row-gap-4 column-gap-5 justify-content-center mb-4">
        <p id="{{ $category_name }}" class="m-0 fw-semibold fs-5 col-11">{{ $category_name }}</p>
        @foreach ($products as $product)
            <!-- Modal -->

            <div class="modal fade" id="{{ Str::slug($product['model']) }}Modal" tabindex="-1" aria-hidden="true"
                data-product-id="{{ $product['id'] }}">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                    <div class="modal-content">
                        <div class="modal-header d-none d-sm-block">
                            <i class="bx bx-x fs-1 position-absolute top-0 start-0 pointer pt-2 ps-2"
                                data-bs-dismiss="modal"></i>
                            <p
                                class="m-0 fs-5 fw-semibold text-center position-absolute top-0 start-50 translate-middle-x pt-2 lh-1">
                                <small>{{ $product['model'] }}</small>
                            </p>
                        </div>
                        <div class="d-block d-sm-none">
                            <svg class="mt-2 ms-2 pointer" xmlns="http://www.w3.org/2000/svg" width="32"
                                height="32" fill="#2b1a46" viewBox="0 0 16 16" data-bs-dismiss="modal">
                                <g fill-rule="evenodd">
                                    <circle cx="8" cy="8" r="8" fill="#EAE3E3"></circle>
                                    <path
                                        d="m5.849 5.096.075.062L8 7.235l2.076-2.077a.541.541 0 0 1 .828.69l-.062.076L8.765 8l2.077 2.076a.541.541 0 0 1-.69.828l-.076-.062L8 8.765l-2.076 2.077a.541.541 0 0 1-.828-.69l.062-.076L7.235 8 5.158 5.924a.541.541 0 0 1 .69-.828">
                                    </path>
                                </g>
                            </svg>
                            <div class="w-100">
                                <div class="sm-modal-product-img mx-auto">
                                    <img src="storage/{{ $product['image'] }}" alt="imagen del producto"
                                        class="img-fluid">
                                </div>
                                <div class="px-4 pt-4 pb-2 shadow">
                                    <h3 class="fw-semibold m-0">{{ $product['model'] }}</h3>
                                    <p class="opacity-75 my-2 lh-1">{{ $product['description'] }}</p>
                                    <div class="d-flex align-items-center">
                                        <p class="m-0 fw-semibold me-2">${{ $product['price'] }}</p>
                                        <p class="m-0 opacity-75 text-decoration-line-through">
                                            <small>
                                                ${{ rand($product['price'] + 750, $product['price'] + 1000) }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-body shadow-sm d-none d-sm-block">
                            <div class="modal-product-img m-auto">
                                <img src="storage/{{ $product['image'] }}" alt="imagen del producto" class="img-fluid">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="lh-1">
                                    <h3 class="fw-semibold m-0">{{ $product['model'] }}</h3>
                                    <p class="opacity-75 m-0">{{ $product['description'] }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="m-0 fw-semibold me-2">
                                        $<span id="price-{{ $product['id'] }}">{{ $product['price'] }}</span>
                                    </p>
                                    <p class="m-0 opacity-75 text-decoration-line-through">
                                        <small>
                                            ${{ rand($product['price'] + 750, $product['price'] + 1000) }}
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm p-3 mx-3 my-4 rounded-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="m-0 fs-5 fw-semibold">
                                    <small>Unidades</small>
                                </p>
                                <div class="d-flex align-items-center fw-semibold">
                                    <button
                                        class="minus-btn border-0 rounded-end rounded-pill bg-secondary-subtle px-2 py-1"
                                        data-id="{{ $product['id'] }}">
                                        <i id="minus" class="bx bx-minus bx-fw m-auto"></i>
                                    </button>
                                    <p class="m-0 bg-secondary-subtle py-1 quantity" id="amount-{{ $product['id'] }}">1
                                    </p>
                                    <button
                                        class="plus-btn border-0 rounded-start rounded-pill bg-secondary-subtle px-2 py-1"
                                        data-id="{{ $product['id'] }}">
                                        <i id="plus" class="bx bx-plus bx-fw m-auto"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer px-4 product-modal-footer">
                            <form id="add-to-cart-form-{{ $product['id'] }}" data-product-id="{{ $product['id'] }}"
                                class="w-100">
                                @csrf
                                <button type="submit" data-bs-dismiss="modal"
                                    class="btn-add-order border-0 rounded-pill d-flex align-items-center justify-content-between w-100 px-5 py-2 text-light">
                                    <p class="m-0 rounded-circle border border-white fw-semibold amount">
                                        <small id="amount2-{{ $product['id'] }}">1</small>
                                    </p>
                                    <p class="m-0 fw-semibold">Agregar a mi pedido</p>
                                    <p class="m-0 fw-semibold">
                                        $<span id="payment-{{ $product['id'] }}">{{ $product['price'] }}</span>
                                    </p>
                                </button>
                                <input type="hidden" name="user"
                                    value="{{ Auth::check() ? Auth::user()->id : '' }}">
                                <input type="hidden" name="business" value="{{ $business['id'] }}">
                                <input type="hidden" name="quantity" id="quantity-{{ $product['id'] }}"
                                    value="1">
                                <input type="hidden" name="productsByCategory"
                                    value="{{ json_encode($productsByCategory) }}">
                                <input type="hidden" name="cartProducts"
                                    value="{{ json_encode($cartProducts ?? []) }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-5 shadow pointer user-select-none" data-bs-toggle="modal"
                data-bs-target="#{{ Str::slug($product['model']) }}Modal">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 fs-5 lh-1"><small>{{ $product['model'] }}</small></p>
                        <p class="mb-2 opacity-75 lh-1"><small>{{ $product['description'] }}</small></p>
                        <div class="d-flex align-items-center">
                            <p class="m-0 fs-5 fw-semibold">${{ $product['price'] }}</p>
                        </div>
                    </div>
                    <div class="product-img-container">
                        <img src="storage/{{ $product['image'] }}" alt="imagen del producto" class="img-fluid">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
