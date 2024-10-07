<div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="position-relative">
                <h5 class="fw-semibold position-absolute top-0 start-50 translate-middle-x m-0 pt-2">
                    Editar categoría
                </h5>
                <i role="button" class="bx bx-x position-absolute top-0 end-0 bx-md opacity-75" data-bs-dismiss="modal"
                    aria-label="Close"></i>
            </div>
            <div class="modal-body mt-5 border-top">
                <input type="hidden" name="category" id="edit-selected-category" value="{{ $category->id }}">
                <input type="text" name="name" id="edit-category-name" class="form-control"
                    value="{{ $category->name }}" placeholder="Nombre*">
            </div>
            <div class="modal-footer">
                <button id="edit-category" class="bg-red rounded-1 w-100 border-0 text-light py-2"
                    data-bs-dismiss="modal">
                    Editar
                </button>
            </div>
        </div>
    </div>
</div>
