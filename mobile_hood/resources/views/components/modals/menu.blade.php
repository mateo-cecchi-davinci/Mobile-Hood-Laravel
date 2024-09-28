<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            @foreach ($productsByCategory as $category_name => $products)
                <a href="#{{ $category_name }}" class="modal-header d-flex flex-column text-decoration-none text-dark">
                    <h5 class="fw-semibold m-auto"><small>{{ $category_name }}</small></h5>
                    <p class="m-0 opacity-75">
                        <small>
                            {{ count($products) . ' ' . 'productos' }}
                        </small>
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</div>
