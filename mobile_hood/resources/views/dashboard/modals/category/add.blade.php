<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="position-relative">
                <h5 class="fw-semibold position-absolute top-0 start-50 translate-middle-x m-0 pt-2">
                    Agregar categoría
                </h5>
                <i role="button" class="bx bx-x position-absolute top-0 end-0 bx-md opacity-75" data-bs-dismiss="modal"
                    aria-label="Close"></i>
            </div>
            <div class="modal-body mt-5 border-top">
                <input type="text" name="name" id="add-category-name" class="form-control mb-3"
                    placeholder="Nombre*">
                {{-- <select name="category" id="add-parent-category" class="form-select">
                    <option value="" selected>Elegí una categoría padre</option>
                    @foreach ($data as $category)
                        @if ($category->hasChildren())
                            <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @foreach ($category->children as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select> --}}
            </div>
            <div class="modal-footer">
                <button id="add-category" class="bg-red rounded-1 w-100 border-0 text-light py-2"
                    data-bs-dismiss="modal">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>
