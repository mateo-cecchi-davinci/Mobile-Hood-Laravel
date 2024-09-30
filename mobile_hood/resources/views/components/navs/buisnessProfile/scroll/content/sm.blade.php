<div class="d-flex align-items-center my-2">
    <i class="bx bx-chevron-left fs-1" style="padding-left: 3%"></i>
    <p class="fw-semibold fs-5 nav-sm-buisness-name">{{ $name }}</p>
</div>
<div class="sm-nav">
    @include('components.carousels.menu', [
        'productsByCategory' => $productsByCategory,
        'categories' => $categories,
    ])
</div>
