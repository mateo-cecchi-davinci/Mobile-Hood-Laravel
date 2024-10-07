<div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="position-relative">
                <h5 class="fw-semibold position-absolute top-0 start-50 translate-middle-x m-0 pt-2">
                    Eliminar categoría
                </h5>
                <i role="button" class="bx bx-x position-absolute top-0 end-0 bx-md opacity-75" data-bs-dismiss="modal"
                    aria-label="Close"></i>
            </div>
            <div class="modal-body mt-5 border-top text-center">
                <i class="bx bx-error-circle bx-lg cancel mb-3" aria-label="Warning"></i>
                <h5 class="m-0 opacity-75">¿Está seguro que desea eliminar esta categoría?</h5>
                <h5 class="m-0 my-3 opacity-75">¡Se perderán todos sus productos!</h5>
                <h5 class="m-0 fw-semibold">*{{ $category->name }}*</h5>
                <input type="hidden" name="category" id="delete-selected-category" value="{{ $category->id }}">
            </div>
            <div class="border-top d-flex align-items-center justify-content-evenly py-3">
                <p role="button" data-bs-dismiss="modal" class="m-0 me-3 fw-medium cancel">Cancelar</p>
                <button id="delete-category" class="bg-red rounded-1 border-0 text-light px-3 py-2"
                    data-bs-dismiss="modal">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</div>
