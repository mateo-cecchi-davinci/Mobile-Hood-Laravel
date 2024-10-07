<button data-bs-toggle="modal" data-bs-target="#addCategory"
    class="bg-red rounded-1 w-100 border-0 text-light py-2 mb-5">AGREGAR</button>
<button id="categories-btn"
    class="d-flex align-items-center justify-content-between border-0 bg-transparent w-100 px-0 btn-categories"
    data-bs-toggle="collapse" data-bs-target="#categories" aria-expanded="false">
    <div class="d-flex align-items-center">
        <i class="bx bx-notepad bx-sm me-1"></i>
        <span>Categorías</span>
    </div>
    <i id="categories-icon" class="bx bx-chevron-down bx-sm pt-1"></i>
</button>

<div class="collapse" id="categories">
    @foreach ($data as $category)
        @if ($category->products()->exists())
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
                        </div>
                    </button>
                </form>
            </div>
        @endif

        {{-- @if ($category->hasChildren())
            <div id="category-{{ $category->id }}" class="collapse text-nowrap">
                @include('dashboard.menu.categories', ['categories' => $category->children])
            </div>
        @endif --}}
    @endforeach
</div>

<div class="my-3 border-bottom"></div>
<div class="d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
        <i class="bx bx-purchase-tag-alt bx-sm me-2"></i>
        <span>Promociones</span>
    </div>
    <i class="bx bx-chevron-down bx-sm pt-1"></i>
</div>
<div class="my-3 border-bottom"></div>
