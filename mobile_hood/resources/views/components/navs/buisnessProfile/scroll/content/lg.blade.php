<div class="d-flex align-items-center my-2">
    <div class="d-flex align-items-center me-4">
        <a href="{{ route('home') }}">
            <i class="bx bx-chevron-left fs-1 fw-medium opacity-75 text-dark pt-1"></i>
        </a>
        <a class="p-0 logo-container-2" href="{{ route('home') }}">
            <img src="/img/logos/logo_circle.png" alt="mobile hood logo">
        </a>
    </div>
    <div style="width: 520px;">
        @include('components.inputs.products', [
            'id' => $id,
        ])
    </div>
</div>
