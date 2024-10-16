<div class="d-flex justify-content-center mt-5">
    <div id="businessLat" class="d-none">
        {{ $business->location->lat }}
    </div>
    <div id="businessLng" class="d-none">
        {{ $business->location->lng }}
    </div>
    <div class="row w-100 container row-gap-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center mb-4">
                <h3 class="m-0 me-2 fw-semibold">Nuevo</h3>
                <p class="m-0 fw-5 red fw-semibold">{{ count($pendingOrders) }}</p>
            </div>
            @if ($pendingOrders->isEmpty())
                <p class="m-0 p-4 bg-body-secondary fw-medium rounded-1">No hay nuevos pedidos</p>
            @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($pendingOrders as $order)
                    @php
                        $amount = count($order->products);
                        $counter++;
                    @endphp
                    <button data-bs-toggle="modal" data-bs-target="#{{ $order->id }}-new"
                        class="bg-red p-3 text-light rounded-1 d-flex align-items-center justify-content-between mb-3 shadow border-0 w-100">
                        <div>
                            {{-- 
                                    Con str_pad($counter++, 2, '0', STR_PAD_LEFT), 
                                    le dices a PHP que rellene el número con ceros a la izquierda (STR_PAD_LEFT) 
                                    hasta que alcance una longitud de 2 caracteres. 
                                --}}
                            <h5 class="m-0 fw-semibold text-start">#{{ str_pad($counter, 2, '0', STR_PAD_LEFT) }}</h5>
                            <p class="m-0">
                                {{ $amount }}
                                {{ $amount == 1 ? 'producto' : 'productos' }}
                            </p>
                        </div>
                        <p class="m-0">
                            <span class="fw-semibold">10</span> minutos
                        </p>
                    </button>

                    {{-- New incoming orders modals --}}

                    <div class="modal fade" id="{{ $order->id }}-new" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header justify-content-between py-1 ps-2 border-0">
                                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bx bx-x bx-md"></i>
                                    </button>
                                    <p role="button" class="red m-0 fw-semibold"
                                        data-bs-target="#{{ $order->id }}-reject" data-bs-toggle="modal">
                                        Rechazar
                                    </p>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="row w-100 gx-0 tall-modal mt-2">
                                        <div class="col-xl-5 d-flex flex-column justify-content-between">
                                            <div>
                                                <p class="m-0 opacity-75 fw-medium ms-4 ps-1 lh-1">
                                                    {{ $business->name }}
                                                </p>
                                                <div class="red-border">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center ms-4 my-3">
                                                        <h1 class="m-0 lh-1 fw-bold">
                                                            Pedido nº
                                                            {{ str_pad($counter, 2, '0', STR_PAD_LEFT) }}
                                                        </h1>
                                                        <p class="m-0 pe-4 opacity-75">
                                                            <span class="fw-semibold">10</span> minutos
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="my-4 border-bottom border-3"></div>
                                                <div class="d-flex align-items-center ms-4">
                                                    <i class="bx bx-run pt-1 bx-sm me-2"></i>
                                                    <div>
                                                        <p class="m-0 sm-font red lh-1 fw-semibold">Cliente</p>
                                                        <p class="m-0 opacity-75">
                                                            {{ $order->user->name }} está camino...
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="top-shadow p-3 pt-2 d-none d-xl-block">
                                                <p class="text-success fw-semibold mb-2">
                                                    Retiro en aproximadamente 10 minutos
                                                </p>
                                                <button wire:click="acceptOrder({{ $order->id }})"
                                                    data-bs-dismiss="modal"
                                                    class="border-0 bg-success text-light fw-semibold rounded-1 px-5 py-3 w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Aceptar</span>
                                                        <span>
                                                            {{ $amount == 1 ? 'Producto: ' : 'Productos: ' }}
                                                            {{ $amount }}
                                                        </span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                        <div
                                            class="col-xl-7 bg-body-tertiary rounded-bottom rounded-2 d-flex flex-column justify-content-between">
                                            @php
                                                $total = 0;
                                            @endphp
                                            <div class="p-4">
                                                @foreach ($order->products as $product)
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex">
                                                            <p class="red m-0 fw-semibold me-2">
                                                                <span>
                                                                    {{ $product->pivot->amount . ' ' }}
                                                                </span>
                                                                <span>x</span>
                                                            </p>
                                                            <h5 class="m-0 fw-semibold lh-1">
                                                                {{ $product->model }}
                                                            </h5>
                                                        </div>
                                                        <p class="m-0 fw-medium">
                                                            ${{ $product->price }}
                                                        </p>
                                                    </div>
                                                    <div class="my-3 border-bottom"></div>
                                                    @php
                                                        $total += $product->price;
                                                    @endphp
                                                @endforeach
                                                <div
                                                    class="d-flex justify-content-between align-items-center mt-4 mb-2">
                                                    <p class="m-0 fw-bold fs-5">Total</p>
                                                    <p class="m-0 fw-bold">
                                                        ${{ $total }}
                                                    </p>
                                                </div>
                                                <p
                                                    class="w-100 m-0 bg-success-subtle text-center text-success sm-font px-2 py-1 rounded-1 fw-semibold">
                                                    TARJETA
                                                </p>
                                            </div>
                                            <div>
                                                <div class="top-shadow p-3 pt-2 d-block d-xl-none">
                                                    <p class="text-success fw-semibold mb-2">
                                                        Retiro en aproximadamente 10 minutos
                                                    </p>
                                                    <button wire:click="acceptOrder({{ $order->id }})"
                                                        data-bs-dismiss="modal"
                                                        class="border-0 bg-success text-light fw-semibold rounded-1 px-5 py-3 w-100">
                                                        <div class="d-flex justify-content-between">
                                                            <span>Aceptar</span>
                                                            <span>
                                                                {{ $amount == 1 ? 'Producto: ' : 'Productos: ' }}
                                                                {{ $amount }}
                                                            </span>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="{{ $order->id }}-reject" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header justify-content-between py-1 ps-2 border-0">
                                    <button type="button" class="bg-transparent border-0"
                                        data-bs-target="#{{ $order->id }}-new" data-bs-toggle="modal"
                                        aria-label="Go back">
                                        <i class="bx bx-chevron-left bx-md"></i>
                                    </button>
                                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bx bx-x bx-md"></i>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <h1 class="fw-bold mb-4">Es triste verte rechazar :(</h1>
                                    <p class="mb-5">Seleccioná tus motivos para rechazar</p>
                                    <div
                                        class="d-flex flex-column align-items-center align-items-sm-start justify-content-sm-center flex-sm-row column-gap-3 row-gap-3 mb-5">
                                        <div
                                            class="reject-col shadow border p-4 d-flex flex-column align-items-center justify-content-between">
                                            <i class="bx bx-x-circle bx-md mb-4"></i>
                                            <p class="m-0 lh-1">Local cerrado</p>
                                        </div>
                                        <div
                                            class="reject-col shadow border p-4 d-flex flex-column align-items-center justify-content-between">
                                            <i class="bx bx-time bx-md mb-4"></i>
                                            <p class="m-0 lh-1">Hay mucha demanda en el local</p>
                                        </div>
                                        <div role="button" data-bs-target="#{{ $order->id }}-not-enough-products"
                                            data-bs-toggle="modal"
                                            class="reject-col shadow border p-4 d-flex flex-column align-items-center justify-content-between">
                                            <i class="bx bx-shopping-bag bx-md mb-4"></i>
                                            <p class="m-0 lh-1">Falta de productos para el pedido</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="{{ $order->id }}-not-enough-products" tabindex="-1"
                        aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content tall-modal">
                                <div class="modal-header justify-content-between py-1 ps-2 border-0">
                                    <button type="button" class="bg-transparent border-0"
                                        data-bs-target="#{{ $order->id }}-reject" data-bs-toggle="modal"
                                        aria-label="Go back">
                                        <i class="bx bx-chevron-left bx-md"></i>
                                    </button>
                                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bx bx-x bx-md"></i>
                                    </button>
                                </div>
                                <div class="modal-body text-center p-0 bg-body-tertiary">
                                    <div class="bg-white">
                                        <h1 class="fw-bold pb-4 px-4">¿Qué productos no están disponibles?</h1>
                                        <p class="pb-4 px-4 m-0">
                                            Estos productos serán marcados como no disponibles por el resto del día.
                                        </p>
                                    </div>
                                    <div class="p-5 border-top">
                                        @foreach ($order->products as $product)
                                            <div class="d-flex mb-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" wire:model.defer="unavailableProducts"
                                                        value="{{ $product->id }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <p class="m-0 fw-medium">
                                                    {{ $product->model }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="p-3 top-shadow position-absolute bottom-0 start-0 end-0 bg-white">
                                        <button data-bs-target="#{{ $order->id }}-save-order"
                                            data-bs-toggle="modal"
                                            class="bg-red fw-semibold text-light border-0 rounded-1 w-100 py-3">
                                            Continuar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="{{ $order->id }}-save-order" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content tall-modal">
                                <div class="modal-header justify-content-between py-1 ps-2 border-0">
                                    <button type="button" class="bg-transparent border-0"
                                        data-bs-target="#{{ $order->id }}-not-enough-products"
                                        data-bs-toggle="modal" aria-label="Go back">
                                        <i class="bx bx-chevron-left bx-md"></i>
                                    </button>
                                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bx bx-x bx-md"></i>
                                    </button>
                                </div>
                                <div class="modal-body text-center p-0">
                                    <div class="bg-white">
                                        <h1 class="fw-bold px-4">¡Salvemos el pedido!</h1>
                                        <p class="pb-4 px-4 m-0">
                                            Intentá llamar al cliente para ofrecerle un producto alternativo de valor
                                            similar.
                                        </p>
                                    </div>
                                    <div class="p-5 border-top">
                                        <div class="p-3 d-flex align-items-center bg-body-tertiary">
                                            <i class="bx bx-shopping-bag bx-sm me-3"></i>
                                            <p class="m-0 d-flex flex-column text-start">
                                                <span class="sm-font red fw-semibold">
                                                    {{ $order->user->name }}
                                                </span>
                                                <span class="fw-semibold">
                                                    +{{ $order->user->phone }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="p-3 top-shadow position-absolute bottom-0 start-0 end-0 bg-white">
                                        <button wire:click="loadProducts()" data-bs-toggle="modal"
                                            data-bs-target="#{{ $order->id }}-edit-order"
                                            class="bg-success fw-semibold text-light border-0 rounded-1 w-100 py-3">
                                            Modificar orden
                                        </button>
                                        <p role="button" wire:click="rejectOrder({{ $order->id }})"
                                            data-bs-dismiss="modal" class="m-0 red fw-semibold pt-3">
                                            Rechazar pedido
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="{{ $order->id }}-edit-order" tabindex="-1" aria-hidden="true"
                        wire:ignore.self>
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content tall-modal">
                                <div class="modal-header justify-content-between py-1 ps-2 border-0">
                                    <button type="button" class="bg-transparent border-0"
                                        data-bs-target="#{{ $order->id }}-save-order" data-bs-toggle="modal"
                                        aria-label="Go back">
                                        <i class="bx bx-chevron-left bx-md"></i>
                                    </button>
                                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bx bx-x bx-md"></i>
                                    </button>
                                </div>
                                <div class="modal-body text-center p-0">
                                    <div class="bg-white">
                                        <h1 class="fw-bold px-4">Modificar pedido</h1>
                                        <p class="pb-4 px-4 m-0">
                                            Seleccioná los nuevos productos elegidos por el cliente.
                                        </p>
                                    </div>
                                    <div class="d-flex flex-column justify-content-between border-top">
                                        <div class="px-5 py-3 new-products">
                                            @foreach ($products as $product)
                                                <div class="d-flex mb-4">
                                                    <label class="checkbox">
                                                        <input type="checkbox" wire:model.defer="newProducts"
                                                            value="{{ $product->id }}">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p class="m-0 fw-medium">
                                                        {{ $product->model }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="p-3 top-shadow bg-white rounded-bottom-3">
                                            <button wire:click="editAndAcceptOrder({{ $order->id }})"
                                                data-bs-dismiss="modal"
                                                class="bg-success fw-semibold text-light border-0 rounded-1 w-100 py-3">
                                                Aceptar orden
                                            </button>
                                            <p role="button" wire:click="rejectOrder({{ $order->id }})"
                                                data-bs-dismiss="modal" class="m-0 red fw-semibold pt-3">
                                                Rechazar pedido
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center mb-4">
                <h3 class="m-0 me-2 fw-semibold">Aceptado</h3>
                <p class="m-0 fw-5 red fw-semibold">{{ count($acceptedOrders) }}</p>
            </div>
            @if ($acceptedOrders->isEmpty())
                <p class="m-0 p-4 bg-body-secondary fw-medium rounded-1">No hay pedidos aceptados</p>
            @else
                @php
                    $counter = 0;
                @endphp
                @foreach ($acceptedOrders as $order)
                    @php
                        $amount = count($order->products);
                        $counter++;
                    @endphp
                    <div role="button" class="p-2 bg-white rounded-1 border mb-3 shadow" data-bs-toggle="modal"
                        data-bs-target="#{{ $order->id }}-accepted">
                        <div class="red-border ps-3">
                            <div class="d-flex justify-content-between">
                                <h5 class="m-0 fw-semibold">#{{ str_pad($counter, 2, '0', STR_PAD_LEFT) }}</h5>
                                <div class="d-flex align-items-start">
                                    <p class="m-0 p-1 bg-success-subtle text-success sm-font me-2 fw-semibold">
                                        TRANSFERENCIA
                                    </p>
                                    <button class="border-0 rounded-1 bg-secondary-subtle">
                                        <i class="bx bx-check bx-sm pt-1 opacity-75 fw-bold"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="m-0 lh-1">
                                {{ $amount }}
                                {{ $amount == 1 ? 'producto' : 'productos' }}
                            </p>
                        </div>
                        <div class="my-2 border-bottom"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bx bx-run pt-1 bx-sm me-2"></i>
                                <p class="m-0">{{ $order->user->name }}</p>
                            </div>
                            <p class="m-0">
                                <span class="fw-semibold">10</span> minutos
                            </p>
                        </div>
                    </div>

                    {{-- Accepted orders modals --}}

                    <div class="modal fade" id="{{ $order->id }}-accepted" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header justify-content-between py-1 ps-2 border-0">
                                    <button type="button" class="bg-transparent border-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="bx bx-x bx-md"></i>
                                    </button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="tall-modal mt-2 bg-body-tertiary">
                                        <div class="d-flex flex-column justify-content-between">
                                            <div class="bg-white pb-4">
                                                <p class="m-0 opacity-75 fw-medium ms-4 ps-1 lh-1">
                                                    {{ $business->name }}
                                                </p>
                                                <div class="red-border">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center ms-4 my-3">
                                                        <h1 class="m-0 lh-1 fw-bold">
                                                            Pedido nº
                                                            {{ str_pad($counter, 2, '0', STR_PAD_LEFT) }}
                                                        </h1>
                                                        <p class="m-0 pe-4 opacity-75">
                                                            <span class="fw-semibold">10</span> minutos
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="my-4 border-bottom border-3"></div>
                                                <div class="d-flex justify-content-between align-items-center px-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bx bx-run pt-1 bx-sm me-2"></i>
                                                        <div>
                                                            <p class="m-0 sm-font red lh-1 fw-semibold">
                                                                Cliente
                                                            </p>
                                                            <p class="m-0 opacity-75">
                                                                {{ $order->user->name }} está camino...
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <i role="button"
                                                        class="bx bx-map bx-sm bx-border bg-red text-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#{{ $order->id }}-location">
                                                    </i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rounded-bottom rounded-2 mt-2">
                                            @php
                                                $total = 0;
                                            @endphp
                                            <div class="p-4">
                                                @foreach ($order->products as $product)
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex">
                                                            <p class="red m-0 fw-semibold me-2">
                                                                <span>
                                                                    {{ $product->pivot->amount . ' ' }}
                                                                </span>
                                                                <span>x</span>
                                                            </p>
                                                            <h5 class="m-0 fw-semibold lh-1">
                                                                {{ $product->model }}
                                                            </h5>
                                                        </div>
                                                        <p class="m-0 fw-medium">
                                                            ${{ $product->price }}
                                                        </p>
                                                    </div>
                                                    <div class="my-3 border-bottom"></div>
                                                    @php
                                                        $total += $product->price;
                                                    @endphp
                                                @endforeach
                                                <div
                                                    class="d-flex justify-content-between align-items-center mt-4 mb-2">
                                                    <p class="m-0 fw-bold fs-5">Total</p>
                                                    <p class="m-0 fw-bold">
                                                        ${{ $total }}
                                                    </p>
                                                </div>
                                                <p
                                                    class="w-100 m-0 bg-success-subtle text-center text-success sm-font px-2 py-1 rounded-1 fw-semibold">
                                                    TARJETA
                                                </p>
                                            </div>
                                            <div
                                                class="top-shadow p-3 position-absolute start-0 bottom-0 end-0 bg-white">
                                                <button wire:click="readyOrder({{ $order->id }})"
                                                    data-bs-dismiss="modal"
                                                    class="border-0 bg-primary text-light fw-semibold rounded-1 px-5 py-3 w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Listo para la entrega</span>
                                                        <span>
                                                            {{ $amount == 1 ? 'Producto: ' : 'Productos: ' }}
                                                            {{ $amount }}
                                                        </span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="{{ $order->id }}-location" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header py-1 ps-2 border-0 shadow-lg">
                                    <button type="button" class="bg-transparent border-0 me-4"
                                        data-bs-target="#{{ $order->id }}-accepted" data-bs-toggle="modal"
                                        aria-label="Go back">
                                        <i class="bx bx-chevron-left bx-md"></i>
                                    </button>
                                    <p class="m-0">
                                        <span class="fw-semibold me-2">Tiempo restante:</span>
                                        <span>11 minutos</span>
                                    </p>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="tall-modal">
                                        <div wire:ignore id="map" class="user-location"></div>
                                        <div class="position-absolute start-0 bottom-0 end-0 p-4">
                                            <button type="button" data-bs-target="#{{ $order->id }}-accepted"
                                                data-bs-toggle="modal"
                                                class="bg-red border-0 rounded-1 py-3 w-100 text-light fw-semibold">
                                                Volver a los detalles del pedido
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
