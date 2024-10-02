<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="/css/orders/styles.css">

    <title>{{ config('app.name', 'Mobile Hood') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-body-tertiary">
    <nav class="navbar navbar-expand bg-white p-0 border-bottom fixed-top">
        <div class="d-flex align-items-center my-2 me-4">
            <form action="{{ route('home') }}" method="GET">
                @csrf
                <button class="border-0 bg-transparent ms-2" type="submit">
                    <i class="bx bx-chevron-left text-dark pt-1 me-3 fs-1"></i>
                </button>
            </form>
            <div class="p-0 logo-container">
                <img src="/img/logos/logo_circle.png" alt="mobile hood logo" class="img-fluid">
            </div>
        </div>
    </nav>

    <div class="d-flex h-100">
        <div id="buisnessLat" class="d-none">{{ $buisness->location->lat }}</div>
        <div id="buisnessLng" class="d-none">{{ $buisness->location->lng }}</div>
        <div id="orderTime" class="d-none">{{ $order->created_at }}</div>
        <div id="map" class="w-100 h-100">

        </div>
        <div class="order-state text-light p-3">
            <h3 class="fw-medium">Preparando tu orden...</h3>
            <div class="d-flex align-items-center mb-3">
                <p class="m-0 sm-font me-1 fw-light">El pedido estará listo entre</p>
                <p class="m-0">
                    {{ \Carbon\Carbon::parse($order->created_at)->addMinutes(5)->format('h:i A') }}
                    {{ ' - ' }}
                    {{ \Carbon\Carbon::parse($order->created_at)->addMinutes(10)->format('h:i A') }}
                </p>
            </div>
            <div class="d-flex align-items-center icons mb-3">
                <i class="bx bx-store bx-border-circle bx-sm bg-light"></i>
                <div class="d-flex w-100 align-items-center position-relative">
                    <div class="my-3 border-bottom border-light border-3 w-100"></div>
                    <div class="d-flex align-items-center w-100 position-absolute time">
                        <i class="bx bx-time-five bx-border-circle bx-sm bg-light"></i>
                    </div>
                </div>
                <i class="bx bx-dish bx-border-circle bx-sm bg-light"></i>
            </div>
            <p class="m-0 lh-1 fw-light">{{ $buisness->name }} está preparando tu orden</p>
            <div class="mt-4 mb-3 border-bottom border-light opacity-75"></div>
            <div role="button" class="d-flex justify-content-center align-items-center">
                <p class="m-0 fw-medium me-1 btn-hola">Ver detalles</p>
                <i class="bx bx-chevron-down bx-sm"></i>
            </div>
        </div>
    </div>
</body>

<script src="/js/components/prepearingOrder.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ $maps }}&libraries=directions&callback=initMap&libraries=marker"
    async defer></script>
<script src="/js/Google/order.js"></script>

</html>
