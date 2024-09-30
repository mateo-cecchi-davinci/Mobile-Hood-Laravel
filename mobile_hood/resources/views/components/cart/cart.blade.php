<div class="card py-2 px-4 shadow sticky-card d-none d-xl-block">
    @if (empty($cartProducts))
        <p class="m-0 fw-semibold">Mi pedido</p>
        <div class="text-center py-2">
            <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMTExcHgiIGhlaWdodD0iMTAwcHgiIHZpZXdCb3g9IjAgMCAxMTEgMTAwIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA1NC4xICg3NjQ5MCkgLSBodHRwczovL3NrZXRjaGFwcC5jb20gLS0+CiAgICA8dGl0bGU+R3JvdXAgOTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPgogICAgICAgIDxwb2x5Z29uIGlkPSJwYXRoLTEiIHBvaW50cz0iMCAwIDExMC4xNTYyNSAwIDExMC4xNTYyNSA3NS43ODEyNSAwIDc1Ljc4MTI1Ij48L3BvbHlnb24+CiAgICA8L2RlZnM+CiAgICA8ZyBpZD0iVm91Y2hlcnMiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSJDaGFubmVscy1zY3JlZW4tKGlPUykiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMzIuMDAwMDAwLCAtMzQzLjAwMDAwMCkiPgogICAgICAgICAgICA8ZyBpZD0iR3JvdXAtOSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTMyLjAwMDAwMCwgMzQzLjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9Ikdyb3VwLTUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAuMDAwMDAwLCAyNC4yMTg3NTApIj4KICAgICAgICAgICAgICAgICAgICA8bWFzayBpZD0ibWFzay0yIiBmaWxsPSJ3aGl0ZSI+CiAgICAgICAgICAgICAgICAgICAgICAgIDx1c2UgeGxpbms6aHJlZj0iI3BhdGgtMSI+PC91c2U+CiAgICAgICAgICAgICAgICAgICAgPC9tYXNrPgogICAgICAgICAgICAgICAgICAgIDxnIGlkPSJDbGlwLTQiPjwvZz4KICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNNS43NDI5MTE2LDQ0LjU3MzY5NDUgQy0zLjA4ODUxOTEyLDI5LjUyNDUyMiAtMS45ODU2NDIzNSwxMS40ODMyMDczIDEwLjgwMTg2NzgsNC4xMzkxMTE3OSBDMjMuNTg0NzAyMiwtMy4xODUxMTg4MiA0Ny45ODc5NTQ5LDAuMTkzNDU2ODU0IDY3LjkyMzI3ODcsNi42NjAwODQ4NSBDODcuODUzMzAzMSwxMy4xNDY1Nzc3IDEwMy4yODU3ODUsMjIuNzEzOTgzOSAxMDguMjc1MjI3LDMzLjI4MzMyMzMgQzExMy4yOTQyODMsNDMuODYwMTEyIDEwNy44NzA2MSw1NS40MzkxNDQyIDk2Ljc0MjA5MDksNjMuOTkzNzUzNyBDODUuNjQzNDk3Miw3Mi41NTYxMjI5IDY4Ljg0NTM1Niw3OC4wNzQ4MjUyIDUxLjA2ODA5MjEsNzQuODQ5NTgxMyBDMzMuMjk1ODE1OCw3MS42MDQxNjIyIDE0LjU0OTcxNjIsNTkuNTk1MjQyMyA1Ljc0MjkxMTYsNDQuNTczNjk0NSIgaWQ9IkZpbGwtMyIgZmlsbD0iI0Y2RjhGOCIgbWFzaz0idXJsKCNtYXNrLTIpIj48L3BhdGg+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8cGF0aCBkPSJNNjYuMTAyNzA1MSwyNy4zMzcxNTQ0IEM2NS4zMjQ4MzY1LDI3LjQwMDI3NzYgNjQuNTQ2NjI5NSwyNy4wMDc2MjQyIDY0LjE1MjExMjQsMjYuMjc0NTgwNyBDNjEuMzQ5ODkwNiwyMS4wNzA5ODk4IDU3LjM5MDE3MDUsMTguMTExMzI2NSA1Mi4zODMyNTQ1LDE3LjQ3NzcxOSBDNDguNjc5MzI3NywxNy4wMDgwMjgxIDQ1LjcxNjcyNzYsMTguMDI4ODU5MSA0NS42ODc2Mjk0LDE4LjAzOTM3OTcgQzQ0LjYzMjk4OTgsMTguNDIxNTEyNSA0My40Njk0MDEyLDE3Ljg3MTcyOTkgNDMuMDg5NDMzMSwxNi44MTM5MDc0IEM0Mi43MDk0NjUxLDE1Ljc1NTc0NTQgNDMuMjU2NTc4NSwxNC41ODkzMjM5IDQ0LjMxMTU1NjQsMTQuMjA3ODY5NyBDNDQuNDY2NTIxMSwxNC4xNTE1MzQgNDguMTcxNDYzLDEyLjgzODg0MzEgNTIuODkxNzk1OSwxMy40MzcxNTU5IEM1Ny4yNzkxOTE0LDEzLjk5MjM2ODUgNjMuNDE0MTY5MiwxNi4zMzQ3MTQxIDY3LjcyNDQyMDgsMjQuMzM5NDgxNSBDNjguMjU3MzIzNCwyNS4zMjg3NTA5IDY3Ljg4OTUzNiwyNi41NjQ0MDQ0IDY2LjkwMjkwNDksMjcuMDk4NTc1OSBDNjYuNjQ3MTExNiwyNy4yMzczNzkxIDY2LjM3NTA3NzYsMjcuMzE1MDk1MyA2Ni4xMDI3MDUxLDI3LjMzNzE1NDQiIGlkPSJGaWxsLTEiIGZpbGw9IiNBOUIxQjciPjwvcGF0aD4KICAgICAgICAgICAgICAgIDxwYXRoIGQ9Ik00OS4xMjM4NjEyLDU4LjEwOTE3OTQgQzM1LjAwNDEwMTksNTguMTA5MTc5NCAyMy41MjgyOTc2LDQ2LjUxNTM5MzggMjMuNTI4Mjk3NiwzMi4yNjU2Mzc3IEMyMy41MjgyOTc2LDE4LjAxNTIwNDEgMzUuMDA0MTAxOSw2LjQwNjE3Mzc4IDQ5LjEyMzg2MTIsNi40MDYxNzM3OCBDNjMuMjI4NTMxMyw2LjQwNjE3Mzc4IDc0LjcxOTQyNDcsMTguMDE1MjA0MSA3NC43MTk0MjQ3LDMyLjI2NTYzNzcgQzc0LjcxOTQyNDcsNDYuNTE1MzkzOCA2My4yMjg1MzEzLDU4LjEwOTE3OTQgNDkuMTIzODYxMiw1OC4xMDkxNzk0IE05Mi4wNDA3NjcxLDcxLjEyNDc5IEw3My44MjI0NTg0LDUyLjcxODY0MzMgQzc4LjMzODEzOSw0Ny4xNTYwMTEyIDgxLjA2MDIyMjQsNDAuMDMxMzAyNSA4MS4wNjAyMjI0LDMyLjI2NTYzNzcgQzgxLjA2MDIyMjQsMTQuNDUzMDE5MSA2Ni43NTQ2OTg4LDAgNDkuMTIzODYxMiwwIEMzMS40Nzc5MzQ0LDAgMTcuMTg3NSwxNC40NTMwMTkxIDE3LjE4NzUsMzIuMjY1NjM3NyBDMTcuMTg3NSw1MC4wNzc5MTc1IDMxLjQ3NzkzNDQsNjQuNTMwOTM2NiA0OS4xMjM4NjEyLDY0LjUzMDkzNjYgQzU2LjgxMDI3Niw2NC41MzA5MzY2IDYzLjg0NzE4NjYsNjEuNzk2NzA5OCA2OS4zNTI3MTU4LDU3LjIzNDEzMTkgTDg3LjU3MTM1OTgsNzUuNjI0Njk1MSBDODguODA4NjcwNCw3Ni44NzUxMDE2IDkwLjgwMzQ1NjUsNzYuODc1MTAxNiA5Mi4wNDA3NjcxLDc1LjYyNDY5NTEgQzkzLjI3ODA3NzYsNzQuMzkwNTQ5NiA5My4yNzgwNzc2LDcyLjM1ODkzNTQgOTIuMDQwNzY3MSw3MS4xMjQ3OSIgaWQ9IkZpbGwtNiIgZmlsbD0iI0E5QjFCNyI+PC9wYXRoPgogICAgICAgICAgICA8L2c+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4="
                alt="tu pedido está vacío">
            <p class="m-0 fw-semibold fs-5">Tu pedido está vacío</p>
        </div>
    @else
        <div class="d-flex align-items-center justify-content-between border-bottom mb-2">
            <p class="m-0 fw-semibold fs-5">Mi pedido</p>
            <p class="m-0 fw-semibold sm-font pointer edit-cart">Editar</p>
        </div>
        @include('components.cart.order', [
            'cartProducts' => $cartProducts,
        ])

        @include('components.cart.continueButton', [
            'buisness' => $buisness,
            'cartProducts' => $cartProducts,
        ])

        @include('components.cart.deleteButton', [
            'buisness' => $buisness,
            'cartProducts' => $cartProducts,
        ])
    @endif
</div>

@if (!empty($cartProducts))
    <div class="d-block d-xl-none fixed-bottom bg-white cart-nav">
        <button class="border-0 w-100 fw-semibold text-light btn-cart-nav rounded-pill" data-bs-toggle="modal"
            data-bs-target="#cartModal">
            Ver mi pedido $
            <span>
                @include('components.cart.subtotal', [
                    'cartProducts' => $cartProducts,
                ])
            </span>
        </button>
    </div>
    <div class="modal fade" id="cartModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex align-items-center fw-semibold justify-content-between mb-5 px-4 pt-4">
                    <i class="bx bx-chevron-left fs-1 pointer" data-bs-dismiss="modal"></i>
                    <p class="m-0">Mi pedido a retirar</p>
                    <p class="m-0 fw-semibold sm-font pointer edit-cart">Editar</p>
                </div>
                <div class="d-flex align-items-center shadow-sm mb-3 px-4">
                    <div class="sm-img border rounded-2 me-4">
                        <img class="rounded-2 img-fluid" src="storage/{{ $buisness['logo'] }}" alt="logo del negocio">
                    </div>
                    <div>
                        <p class="m-0 fw-semibold">{{ $buisness['name'] }}</p>
                        <p class="m-0 opacity-75">30 - 45 min | $1.669 envío | Mínimo $5.799</p>
                    </div>
                </div>
                <p class="mb-3 fw-semibold px-4">Vas a retirar:</p>
                <div class="px-4 ">
                    @include('components.cart.order', [
                        'cartProducts' => $cartProducts,
                    ])
                </div>
                <div class="my-4 border-bottom"></div>
                <div class="d-flex align-items-center justify-content-between mb-5 px-4">
                    <p class="mb-5">Subtotal</p>
                    <p class="mb-5">$
                        @include('components.cart.subtotal', [
                            'cartProducts' => $cartProducts,
                        ])
                    </p>
                </div>
                <div class="modal-btns-container">
                    @include('components.cart.continueButton', [
                        'buisness' => $buisness,
                        'cartProducts' => $cartProducts,
                    ])
                    @include('components.cart.deleteButton', [
                        'buisness' => $buisness,
                        'cartProducts' => $cartProducts,
                    ])
                </div>

            </div>
        </div>
    </div>
@endif
