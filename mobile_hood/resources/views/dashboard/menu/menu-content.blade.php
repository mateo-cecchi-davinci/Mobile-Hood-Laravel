<div id="category-section">
    @include('dashboard.menu.category-section', [
        'data' => $data,
    ])
</div>
<div class="w-100 products" id="category-component">
    @php
        $first = [];
        foreach ($data as $category) {
            if ($category->hasChildren()) {
                foreach ($category->children as $category) {
                    if ($category->products()->exists()) {
                        $first = $category;
                        break;
                    }
                }
                break;
            } else {
                $first = $category;
                break;
            }
        }
    @endphp
    @include('dashboard.menu.products', [
        'category' => $first,
    ])
</div>
