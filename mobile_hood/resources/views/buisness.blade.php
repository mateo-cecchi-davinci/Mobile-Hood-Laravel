@extends('layouts.buisnessLayout')

@section('content')
    <div class="buisness-header">
        <div class="header text-light">
            <h3>{{ $buisness->name }}</h3>
            <p class="pointer mb-1" data-bs-toggle="modal" data-bs-target="#infoModal">
                {{ $buisness->street . ' ' . $buisness->number }}
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
                        <form id="searchForm" action="{{ route('filter-products') }}" class="col-10" method="GET"
                            onsubmit="return false;">
                            <input type="hidden" name="buisness" id="buisnessId" value="{{ $buisness->id }}">
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
            @foreach ($productsByCategory as $category_name => $products)
                <div class="row row-gap-4 column-gap-5 justify-content-center mb-4">
                    <p id="{{ $category_name }}" class="m-0 fw-semibold fs-5 col-11">{{ $category_name }}</p>
                    @foreach ($products as $product)
                        <div class="card p-3 col-12 col-md-5 shadow pointer">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="m-0 fs-5"><small>{{ $product->model }}</small></p>
                                    <p class="mb-2 opacity-75"><small>{{ $product->description }}</small></p>
                                    <div class="d-flex align-items-center">
                                        <p class="m-0 fs-5 fw-semibold">${{ $product->price }}</p>
                                    </div>
                                </div>
                                <div class="product-img-container">
                                    <img src="{{ $product->getImageURL() }}" alt="imagen del producto" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="col col-xl-3 d-none d-xl-block">
            <div class="card py-2 px-4 shadow">
                <p class="m-0 fw-semibold fs-5"><small>Mi pedido</small></p>
                <div class="text-center py-2">
                    <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMTExcHgiIGhlaWdodD0iMTAwcHgiIHZpZXdCb3g9IjAgMCAxMTEgMTAwIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA1NC4xICg3NjQ5MCkgLSBodHRwczovL3NrZXRjaGFwcC5jb20gLS0+CiAgICA8dGl0bGU+R3JvdXAgOTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPgogICAgICAgIDxwb2x5Z29uIGlkPSJwYXRoLTEiIHBvaW50cz0iMCAwIDExMC4xNTYyNSAwIDExMC4xNTYyNSA3NS43ODEyNSAwIDc1Ljc4MTI1Ij48L3BvbHlnb24+CiAgICA8L2RlZnM+CiAgICA8ZyBpZD0iVm91Y2hlcnMiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSJDaGFubmVscy1zY3JlZW4tKGlPUykiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMzIuMDAwMDAwLCAtMzQzLjAwMDAwMCkiPgogICAgICAgICAgICA8ZyBpZD0iR3JvdXAtOSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTMyLjAwMDAwMCwgMzQzLjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9Ikdyb3VwLTUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAuMDAwMDAwLCAyNC4yMTg3NTApIj4KICAgICAgICAgICAgICAgICAgICA8bWFzayBpZD0ibWFzay0yIiBmaWxsPSJ3aGl0ZSI+CiAgICAgICAgICAgICAgICAgICAgICAgIDx1c2UgeGxpbms6aHJlZj0iI3BhdGgtMSI+PC91c2U+CiAgICAgICAgICAgICAgICAgICAgPC9tYXNrPgogICAgICAgICAgICAgICAgICAgIDxnIGlkPSJDbGlwLTQiPjwvZz4KICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNNS43NDI5MTE2LDQ0LjU3MzY5NDUgQy0zLjA4ODUxOTEyLDI5LjUyNDUyMiAtMS45ODU2NDIzNSwxMS40ODMyMDczIDEwLjgwMTg2NzgsNC4xMzkxMTE3OSBDMjMuNTg0NzAyMiwtMy4xODUxMTg4MiA0Ny45ODc5NTQ5LDAuMTkzNDU2ODU0IDY3LjkyMzI3ODcsNi42NjAwODQ4NSBDODcuODUzMzAzMSwxMy4xNDY1Nzc3IDEwMy4yODU3ODUsMjIuNzEzOTgzOSAxMDguMjc1MjI3LDMzLjI4MzMyMzMgQzExMy4yOTQyODMsNDMuODYwMTEyIDEwNy44NzA2MSw1NS40MzkxNDQyIDk2Ljc0MjA5MDksNjMuOTkzNzUzNyBDODUuNjQzNDk3Miw3Mi41NTYxMjI5IDY4Ljg0NTM1Niw3OC4wNzQ4MjUyIDUxLjA2ODA5MjEsNzQuODQ5NTgxMyBDMzMuMjk1ODE1OCw3MS42MDQxNjIyIDE0LjU0OTcxNjIsNTkuNTk1MjQyMyA1Ljc0MjkxMTYsNDQuNTczNjk0NSIgaWQ9IkZpbGwtMyIgZmlsbD0iI0Y2RjhGOCIgbWFzaz0idXJsKCNtYXNrLTIpIj48L3BhdGg+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8cGF0aCBkPSJNNjYuMTAyNzA1MSwyNy4zMzcxNTQ0IEM2NS4zMjQ4MzY1LDI3LjQwMDI3NzYgNjQuNTQ2NjI5NSwyNy4wMDc2MjQyIDY0LjE1MjExMjQsMjYuMjc0NTgwNyBDNjEuMzQ5ODkwNiwyMS4wNzA5ODk4IDU3LjM5MDE3MDUsMTguMTExMzI2NSA1Mi4zODMyNTQ1LDE3LjQ3NzcxOSBDNDguNjc5MzI3NywxNy4wMDgwMjgxIDQ1LjcxNjcyNzYsMTguMDI4ODU5MSA0NS42ODc2Mjk0LDE4LjAzOTM3OTcgQzQ0LjYzMjk4OTgsMTguNDIxNTEyNSA0My40Njk0MDEyLDE3Ljg3MTcyOTkgNDMuMDg5NDMzMSwxNi44MTM5MDc0IEM0Mi43MDk0NjUxLDE1Ljc1NTc0NTQgNDMuMjU2NTc4NSwxNC41ODkzMjM5IDQ0LjMxMTU1NjQsMTQuMjA3ODY5NyBDNDQuNDY2NTIxMSwxNC4xNTE1MzQgNDguMTcxNDYzLDEyLjgzODg0MzEgNTIuODkxNzk1OSwxMy40MzcxNTU5IEM1Ny4yNzkxOTE0LDEzLjk5MjM2ODUgNjMuNDE0MTY5MiwxNi4zMzQ3MTQxIDY3LjcyNDQyMDgsMjQuMzM5NDgxNSBDNjguMjU3MzIzNCwyNS4zMjg3NTA5IDY3Ljg4OTUzNiwyNi41NjQ0MDQ0IDY2LjkwMjkwNDksMjcuMDk4NTc1OSBDNjYuNjQ3MTExNiwyNy4yMzczNzkxIDY2LjM3NTA3NzYsMjcuMzE1MDk1MyA2Ni4xMDI3MDUxLDI3LjMzNzE1NDQiIGlkPSJGaWxsLTEiIGZpbGw9IiNBOUIxQjciPjwvcGF0aD4KICAgICAgICAgICAgICAgIDxwYXRoIGQ9Ik00OS4xMjM4NjEyLDU4LjEwOTE3OTQgQzM1LjAwNDEwMTksNTguMTA5MTc5NCAyMy41MjgyOTc2LDQ2LjUxNTM5MzggMjMuNTI4Mjk3NiwzMi4yNjU2Mzc3IEMyMy41MjgyOTc2LDE4LjAxNTIwNDEgMzUuMDA0MTAxOSw2LjQwNjE3Mzc4IDQ5LjEyMzg2MTIsNi40MDYxNzM3OCBDNjMuMjI4NTMxMyw2LjQwNjE3Mzc4IDc0LjcxOTQyNDcsMTguMDE1MjA0MSA3NC43MTk0MjQ3LDMyLjI2NTYzNzcgQzc0LjcxOTQyNDcsNDYuNTE1MzkzOCA2My4yMjg1MzEzLDU4LjEwOTE3OTQgNDkuMTIzODYxMiw1OC4xMDkxNzk0IE05Mi4wNDA3NjcxLDcxLjEyNDc5IEw3My44MjI0NTg0LDUyLjcxODY0MzMgQzc4LjMzODEzOSw0Ny4xNTYwMTEyIDgxLjA2MDIyMjQsNDAuMDMxMzAyNSA4MS4wNjAyMjI0LDMyLjI2NTYzNzcgQzgxLjA2MDIyMjQsMTQuNDUzMDE5MSA2Ni43NTQ2OTg4LDAgNDkuMTIzODYxMiwwIEMzMS40Nzc5MzQ0LDAgMTcuMTg3NSwxNC40NTMwMTkxIDE3LjE4NzUsMzIuMjY1NjM3NyBDMTcuMTg3NSw1MC4wNzc5MTc1IDMxLjQ3NzkzNDQsNjQuNTMwOTM2NiA0OS4xMjM4NjEyLDY0LjUzMDkzNjYgQzU2LjgxMDI3Niw2NC41MzA5MzY2IDYzLjg0NzE4NjYsNjEuNzk2NzA5OCA2OS4zNTI3MTU4LDU3LjIzNDEzMTkgTDg3LjU3MTM1OTgsNzUuNjI0Njk1MSBDODguODA4NjcwNCw3Ni44NzUxMDE2IDkwLjgwMzQ1NjUsNzYuODc1MTAxNiA5Mi4wNDA3NjcxLDc1LjYyNDY5NTEgQzkzLjI3ODA3NzYsNzQuMzkwNTQ5NiA5My4yNzgwNzc2LDcyLjM1ODkzNTQgOTIuMDQwNzY3MSw3MS4xMjQ3OSIgaWQ9IkZpbGwtNiIgZmlsbD0iI0E5QjFCNyI+PC9wYXRoPgogICAgICAgICAgICA8L2c+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4="
                        alt="tu pedido está vacío">
                    <p class="m-0 fw-semibold fs-5"><small>Tu pedido está vacío</small></p>
                </div>
            </div>
        </div>

    </div>

    <script src="/js/components/categoriesDropDown.js"></script>
    <script src="/js/components/menu.js"></script>
    <script src="/js/components/input.js"></script>
    <script src="/js/components/toastMsg.js"></script>
@endsection
