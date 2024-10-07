<div class="modal fade" id="deleteProduct{{ $product->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="position-relative">
                <h5 class="fw-semibold position-absolute top-0 start-50 translate-middle-x m-0 pt-2">
                    Eliminar producto
                </h5>
                <i role="button" class="bx bx-x position-absolute top-0 end-0 bx-md opacity-75" data-bs-dismiss="modal"
                    aria-label="Close"></i>
            </div>
            <form action="{{ route('delete-product') }}" method="POST">
                @csrf
                <div class="modal-body mt-5 border-top text-center">
                    <i class="bx bx-error-circle bx-lg cancel mb-3" aria-label="Warning"></i>
                    <h5 class="m-0 opacity-75">¿Está seguro que desea eliminar este producto?</h5>
                    <h5 class="m-0 fw-semibold">*{{ $product->model }}*</h5>
                </div>
                <input type="hidden" name="product" value="{{ $product->id }}">
                <div class="border-top d-flex align-items-center justify-content-evenly py-3">
                    <p role="button" data-bs-dismiss="modal" class="m-0 me-3 fw-medium cancel">Cancelar</p>
                    <button type="submit" class="bg-red rounded-1 border-0 text-light px-3 py-2"
                        data-bs-dismiss="modal">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
