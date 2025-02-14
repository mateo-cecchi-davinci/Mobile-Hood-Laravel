@extends('layouts.businessLayout')

@section('content')
    <div class="business-header" style="background-image: url('{{ $businessModel->getFrontPageURL() }}');">

        <div class="header text-light">
            <h3>{{ $business['name'] }}</h3>
            <p class="pointer mb-1" data-bs-toggle="modal" data-bs-target="#infoModal">
                {{ $business['street'] . ' ' . $business['number'] }}
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

            @include('components.inputs.products', [
                'id' => $business['id'],
            ])
        </div>
    </div>

    <div id="loader-container">
        <video id="loaderVideo" autoplay muted loop>
            <source src="/loader/loader.webm" type="video/mp4">
            Error
        </video>
    </div>

    <div class="row w-100 m-auto p-5 justify-content-center business-profile-content">
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

        @include('components.carousels.menu', [
            'productsByCategory' => $productsByCategory,
            'categories' => $categories,
        ])

        <div id="products-list" class="col col-xl-6">
            @include('components.products', [
                'productsByCategory' => $productsByCategory,
                'cartProducts' => $cartProducts,
            ])
        </div>

        <div id="cart" class="col-12 col-xl-3">
            @include('components.cart.cart', [
                'business' => $business,
                'cartProducts' => $cartProducts,
            ])
        </div>
    </div>

    <script src="/js/components/categoriesDropDown.js"></script>
    <script src="/js/components/menu.js"></script>
    <script src="/js/components/add-products.js"></script>
    <script src="/js/components/edit-cart.js"></script>
@endsection
