<div class="d-flex justify-content-between align-items-center pb-3 border-header">
    <div class="d-flex align-items-center justify-content-between justify-content-sm-start">
        <h3 id="category-name-{{ $category->id }}" class="m-0 me-4 lh-1">{{ $category->name }}</h3>
        <div class="form-check form-switch my-auto d-flex align-items-center">
            <input class="form-check-input switch me-3 pointer" type="checkbox" role="switch"
                id="category-{{ $category->id }}" {{ $category->is_active ? 'checked' : '' }}>
            <span id="category-state" class="opacity-75 font-sm lh-1 d-none d-md-block">
                Categoría {{ $category->is_active ? 'activa' : 'inactiva' }}
            </span>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <button data-bs-toggle="modal" data-bs-target="#addProduct"
            class="rounded-1 bg-transparent btn-add-product lh-1 fw-medium d-flex align-items-center">
            <span class="fs-4 me-2">+</span>
            <span>Agregar producto</span>
        </button>
        <i role="button" data-bs-toggle="modal" data-bs-target="#editCategory" class="bx bx-pencil bx-sm mx-3"></i>
        <i role="button" data-bs-toggle="modal" data-bs-target="#deleteCategory" class="bx bxs-trash bx-sm"></i>
    </div>
</div>
<p id="amount" class="m-0 opacity-75 mt-3">
    @php
        $amount = 0;
        foreach ($category->products as $product) {
            if ($product->is_active) {
                $amount++;
            }
        }
    @endphp
    {{ $amount }} productos activos
</p>

@if ($category->products()->exists())
    @foreach ($category->products as $product)
        <div class="d-md-flex align-items-center justify-content-between border-bottom border-2 py-3">
            <div class="d-md-flex description w-100">
                <div class="product-img-container me-3">
                    <img src="{{ $product->getImageURL() }}" alt="producto" class="img-fluid">
                </div>
                <div class="lh-1 w-100">
                    <h5 class="m-0 mt-3 mb-2">{{ $product->model }}</h5>
                    <p class="m-0 opacity-75 w-75">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <p class="m-0 me-4">${{ $product->price }}</p>
                <div class="d-flex">
                    <div class="form-check form-switch my-auto">
                        <input class="form-check-input switch pointer" type="checkbox" role="switch"
                            id="product-{{ $product->id }}" {{ $product->is_active ? 'checked' : '' }}>
                    </div>
                    <i role="button" data-bs-toggle="modal" data-bs-target="#editProduct{{ $product->id }}"
                        class="bx bx-pencil bx-sm mx-3"></i>
                    <i role="button" data-bs-toggle="modal" data-bs-target="#deleteProduct{{ $product->id }}"
                        class="bx bxs-trash bx-sm"></i>
                </div>
            </div>
        </div>
        @include('dashboard.modals.product.edit', [
            'data' => $data,
            'product' => $product,
        ])
        @include('dashboard.modals.product.delete', [
            'product' => $product,
        ])
    @endforeach
@endif

@include('dashboard.modals.category.add')
@include('dashboard.modals.category.edit', [
    'category' => $category,
])
@include('dashboard.modals.category.delete', [
    'category' => $category,
])
@include('dashboard.modals.product.add')
