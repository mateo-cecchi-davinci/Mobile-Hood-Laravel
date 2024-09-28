<div class="d-block d-xl-none py-2">
    <div class="d-flex flex-nowrap align-items-center">
        <i class="bx bx-search bx-fw my-auto me-2"></i>

        @include('components.carousels.menuBtn', [
            'productsByCategory' => $productsByCategory,
        ])

        <div class="line me-3"></div>

        <div class="scroll-container">
            @foreach ($categories as $category)
                <a href="#{{ $category->name }}"
                    class="btn btn-sm rounded-pill bg-secondary-subtle text-dark fw-semibold me-3">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</div>
