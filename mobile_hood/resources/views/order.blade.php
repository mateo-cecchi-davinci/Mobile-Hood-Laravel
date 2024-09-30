@extends('layouts.orderLayout')
@section('content')
    <div class="container">
        <h2 class="fw-semibold">Información</h2>
        <div class="{{ count($cartProducts) > 3 ? 'info-content-lg' : 'info-content' }} my-4">
            <div class="info">
                <div class="card rounded-1 ps-2 pt-2 shadow mb-4">
                    <div class="d-flex align-items-center border-start border-danger border-opacity-75 border-2">
                        <p class="ms-4 my-3 fw-semibold fs-5"><span class="text-danger me-2">1 -</span>Email</p>
                    </div>
                    <p class="ms-4 mb-5 fs-5 opacity-75">{{ Auth::user()->email }}</p>
                </div>
                <div class="card rounded-1 ps-2 pt-2 shadow mb-4">
                    <div class="d-flex align-items-center border-start border-danger border-opacity-75 border-2">
                        <p class="ms-4 my-3 fw-semibold fs-5"><span class="text-danger me-2">2 -</span>Identificación
                        </p>
                    </div>
                    <div class="ms-4 d-flex align-items-center">
                        <p class="m-0 me-2">Nombre:</p>
                        <p class="m-0 opacity-75">{{ Auth::user()->name . ' ' . Auth::user()->lastname }}</p>
                    </div>
                    <div class="ms-4 mb-5 d-flex align-items-center">
                        <p class="m-0 me-2">Teléfono:</p>
                        <p class="m-0 opacity-75">{{ Auth::user()->phone }}</p>
                    </div>
                </div>
                <div class="card rounded-1 ps-2 pt-2 shadow mb-4">
                    <div class="d-flex align-items-center border-start border-danger border-opacity-75 border-2">
                        <p class="ms-4 my-3 fw-semibold fs-5"><span class="text-danger me-2">3 -</span>Retiro en el
                            local
                        </p>
                    </div>
                    <div class="ms-4 mb-5 d-flex align-items-center">
                        <p class="m-0 me-2 opacity-75 lh-sm">Te notificamos cuando tu pedido esté preparado!</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card px-3 py-3 rounded-1 payment-info shadow">
                    <p class="mb-3 fw-semibold fs-4 text-center">Resumen</p>
                    @php $total = 300; @endphp
                    @foreach ($cartProducts as $cartProduct)
                        @php
                            $total += $cartProduct['product']['price'] * $cartProduct['quantity'];
                        @endphp
                        <div class="d-flex">
                            <div class="img-product me-3">
                                <img src="/storage/{{ $cartProduct['product']['image'] }}" alt="imagen del producto"
                                    class="img-fluid">
                            </div>
                            <div class="d-flex flex-column justify-content-between py-2 w-100">
                                <p class="m-0 sm-font text-truncate fw-semibold">{{ $cartProduct['product']['model'] }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center opacity-75">
                                    <div class="d-flex align-items-center sm-font">
                                        <p class="m-0 me-2">Cantidad:</p>
                                        <span>{{ $cartProduct['quantity'] }}</span>
                                    </div>
                                    <p class="m-0 text-success">$
                                        {{ $cartProduct['product']['price'] * $cartProduct['quantity'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="my-3 border-bottom"></div>
                    @endforeach
                    <div class="d-flex justify-content-between align-items-center opacity-75" role="button">
                        <div class="d-flex align-items-center">
                            <i class="bx bxs-discount bx-fw me-2 my-auto"></i>
                            <p class="m-0">Cupón De Descuento</p>
                        </div>
                        <i class="bx bx-plus fs-3 pt-1"></i>
                    </div>
                    <div class="my-3 border-bottom"></div>
                    <div class="d-flex justify-content-between align-items-center opacity-75 mb-1">
                        <p class="m-0">Subtotal</p>
                        <p class="m-0">$
                            @include('components.cart.subtotal', [
                                'cartProducts' => $cartProducts,
                            ])
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center opacity-75 mb-1">
                        <p class="m-0">Tarifa de servicio</p>
                        <p class="m-0">$ 300</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center opacity-75 mb-1">
                        <p class="m-0">Retiro por el local</p>
                        <p class="m-0 text-success">Gratis</p>
                    </div>
                    <div class="my-3 border-bottom"></div>
                    <div class="d-flex justify-content-between align-items-center text-success opacity-75 mb-5">
                        <p class="m-0">Total</p>
                        <p class="m-0">$
                            {{ $total }}
                        </p>
                    </div>
                    <button class="border-0 rounded-1 text-light red-bg rounded-pill fw-semibold btn-payment">
                        Finalizar compra
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
