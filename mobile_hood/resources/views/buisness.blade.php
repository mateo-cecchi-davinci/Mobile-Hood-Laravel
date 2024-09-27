@extends('layouts.buisnessLayout')

@section('content')
    <div class="buisness-header">
        <div class="header text-light">
            <h3>{{ $buisness['name'] }}</h3>
            <p class="pointer mb-1" data-bs-toggle="modal" data-bs-target="#infoModal">
                {{ $buisness['street'] . ' ' . $buisness['number'] }}
                <i class="bx bxs-map"></i>
            </p>
            <div class="d-flex align-items-center mb-3">
                <div class="d-inline rating rounded-1 me-2">
                    <i class="bx bxs-star ms-1 pt-1"></i>
                    <span class="fw-medium me-1">
                        {{ number_format(rand(37, 47) / 10, 1) }}
                    </span>
                </div>
                <p class="m-0"><small>({{ rand(700, 1200) }})</small></p>
            </div>
            <div class="row w-100">
                <div class="col col-md-6 col-lg-4">
                    <div class="d-flex align-items-center rounded-2">
                        <form id="searchForm" class="col-10">
                            <input type="hidden" name="buisness" id="buisnessId" value="{{ $buisness['id'] }}">
                            <input type="text" id="searchInput" name="query"
                                class="search-input border-0 rounded-start-2 w-100 ps-2" placeholder="Buscar productos...">
                        </form>
                        <div class="search-btn-container bg-white rounded-end-2">
                            <button class="sm-search-btn text-light border-0 mt-2 me-2">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loader-container">
        <video id="loaderVideo" autoplay muted loop>
            <source src="/loader/loader.webm" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="row w-100 m-auto p-5 justify-content-center">
        <div class="col col-xl-3 d-none d-xl-block">
            <div class="card p-4 shadow">
                <div id="btn-categories" class="d-flex align-items-center pointer">
                    <p class="m-0 fw-semibold fs-5"><small>Categorías</small></p>
                    <i id="right-arrow" class="bx bx-chevron-right icon d-block"></i>
                    <i id="down-arrow" class="bx bx-chevron-down icon d-none"></i>
                </div>
                <div id="categories" class="d-none">
                    <div class="d-flex flex-column pt-1">
                        @foreach ($categories as $category)
                            <a class="text-decoration-none text-dark pb-1"
                                href="#{{ $category->name }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block d-xl-none py-4">
            <div class="d-flex flex-nowrap align-items-center">
                <i class="bx bx-search bx-fw my-auto me-2"></i>

                <button type="button" class="btn btn-sm rounded-pill bg-secondary-subtle text-dark fw-semibold"
                    data-bs-toggle="modal" data-bs-target="#menu">
                    <div class="d-flex align-items-center">
                        <span>Menú</span>
                        <i class="bx bx-chevron-down m-0 p-0"></i>
                    </div>
                </button>

                <div class="modal fade" id="menu" tabindex="-1" aria-labelledby="menuLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            @foreach ($productsByCategory as $category_name => $products)
                                <a href="#{{ $category_name }}"
                                    class="modal-header d-flex flex-column text-decoration-none text-dark">
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

                <div class="line me-3"></div>

                <div class="scroll-container">
                    @foreach ($categories as $category)
                        <a href="#{{ $category->name }}"
                            class="btn btn-sm rounded-pill bg-secondary-subtle text-dark fw-semibold me-3">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="products-list" class="col col-xl-6">
            @include('components.products', [
                'productsByCategory' => $productsByCategory,
                'cartProducts' => $cartProducts,
            ])
        </div>

        <div id="cart" class="col-12 col-xl-3">
            @include('components.cart', [
                'buisness' => $buisness,
                'cartProducts' => $cartProducts,
            ])
        </div>
    </div>

    <script src="/js/components/categoriesDropDown.js"></script>
    <script src="/js/components/menu.js"></script>
    <script src="/js/components/add-products.js"></script>
    <script src="/js/components/edit-cart.js"></script>
@endsection
