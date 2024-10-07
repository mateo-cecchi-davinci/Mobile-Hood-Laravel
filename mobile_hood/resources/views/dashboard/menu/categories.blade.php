@foreach ($categories as $category)
    <div class="category-container">
        <form method="POST" id="{{ $category->id }}" class="category">
            @csrf
            <input type="hidden" value="{{ $category->id }}">
            <button type="button" class="bg-transparent py-2 px-0 w-100 btn-category" data-bs-toggle="collapse"
                data-bs-target="#category-{{ $category->id }}" aria-expanded="false"
                aria-controls="category-{{ $category->id }}">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span id="category-name-{{ $category->id }}" class="ps-2">{{ $category->name }}</span>
                    </div>
                    @if ($category->hasChildren())
                        <i class="bx bx-chevron-down bx-sm pt-1"></i>
                    @endif
                </div>
            </button>
        </form>
    </div>

    @if ($category->hasChildren())
        <div id="category-{{ $category->id }}" class="collapse text-nowrap">
            <div class="ps-3">
                @include('dashboard.menu.categories', ['categories' => $category->children])
            </div>
        </div>
    @endif
@endforeach
