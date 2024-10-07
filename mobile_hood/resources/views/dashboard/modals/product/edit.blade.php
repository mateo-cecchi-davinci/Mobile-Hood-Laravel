<div class="modal fade" id="editProduct{{ $product->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="position-relative">
                <h5 class="fw-semibold position-absolute top-0 start-50 translate-middle-x m-0 pt-2">
                    Editar producto
                </h5>
                <i role="button" class="bx bx-x position-absolute top-0 end-0 bx-md opacity-75" data-bs-dismiss="modal"
                    aria-label="Close">
                </i>
            </div>
            <form action="{{ route('edit-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body mt-5 border-top">
                    <input type="text" name="model" class="form-control mb-3" value="{{ $product->model }}"
                        placeholder="Modelo*" required>
                    <input type="text" name="brand" class="form-control mb-3" value="{{ $product->brand }}"
                        placeholder="Marca">
                    <input type="text" name="price" class="form-control mb-3" value="{{ $product->price }}"
                        placeholder="Precio*" required>
                    <input type="text" name="description" class="form-control mb-3"
                        value="{{ $product->description }}" placeholder="Descripción*" required>
                    <input type="number" name="stock" class="form-control mb-3" value="{{ $product->stock }}"
                        placeholder="Stock*" required>
                    <input type="file" name="image" class="form-control">
                    <input type="hidden" name="product" value="{{ $product->id }}" required>
                    <input type="hidden" name="category" value="{{ $category->id }}" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="bg-red rounded-1 w-100 border-0 text-light py-2"
                        data-bs-dismiss="modal">
                        Editar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
