<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="position-relative">
                <h5 class="fw-semibold position-absolute top-0 start-50 translate-middle-x m-0 pt-2">
                    Agregar producto
                </h5>
                <i role="button" class="bx bx-x position-absolute top-0 end-0 bx-md opacity-75" data-bs-dismiss="modal"
                    aria-label="Close"></i>
            </div>
            <form action="{{ route('add-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body mt-5 border-top">
                    <input type="text" name="model" class="form-control mb-3" placeholder="Modelo*" required>
                    <input type="text" name="brand" class="form-control mb-3" placeholder="Marca">
                    <input type="text" name="price" class="form-control mb-3" placeholder="Precio*" required>
                    <input type="text" name="description" class="form-control mb-3" placeholder="Descripción*"
                        required>
                    <input type="number" name="stock" class="form-control mb-3" placeholder="Stock*" required>
                    <select name="category" class="form-select mb-3" required>
                        <option value="" selected>Elegí una categoría</option>
                        @foreach ($data as $category)
                            @if ($category->products()->exists())
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @elseif (!$category->hasChildren())
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button id="add-product" class="bg-red rounded-1 w-100 border-0 text-light py-2"
                        data-bs-dismiss="modal">
                        Agregar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
