@empty($productsByCategory)
    <div id="noResultsToast" class="card bg-primary border-0 rounded-1 py-3 ps-4 pe-3 text-light toast-msg shadow">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center pe-3">
                <i class="bx bxs-info-circle my-auto me-3 lg-icon"></i>
                <p class="fw-semibold m-0 lh-sm">No encontramos "{{ $query }}" en el menú</p>
            </div>
            <i id="close-icon" class="bx bx-x close-icon"></i>
        </div>
    </div>
@endempty
@foreach ($productsByCategory as $category_name => $products)
    <div class="row row-gap-4 column-gap-5 justify-content-center mb-4">
        <p id="{{ $category_name }}" class="m-0 fw-semibold fs-5 col-11">{{ $category_name }}</p>
        @foreach ($products as $product)
            <div class="card p-3 col-12 col-md-5 shadow pointer">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="m-0 fs-5"><small>{{ $product->model }}</small></p>
                        <p class="mb-2 opacity-75"><small>{{ $product->description }}</small></p>
                        <div class="d-flex align-items-center">
                            <p class="m-0 fs-5 fw-semibold">${{ $product->price }}</p>
                        </div>
                    </div>
                    <div class="product-img-container">
                        <img src="{{ $product->getImageURL() }}" alt="imagen del producto" class="img-fluid">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
