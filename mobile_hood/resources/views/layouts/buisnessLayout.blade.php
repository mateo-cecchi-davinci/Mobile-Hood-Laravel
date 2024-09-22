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

    <link rel="stylesheet" href="/css/layout/buisness/styles.css">
    <link rel="stylesheet" href="/css/buisness/styles.css">

    <title>{{ config('app.name', 'Mobile Hood') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('styles')
</head>

<body>

    <nav class="navbar navbar-expand py-0 d-none d-lg-block border-bottom lg-nav">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}"><i
                        class="bx bx-chevron-left fs-1 fw-medium opacity-75 text-dark pt-1"></i></a>
                <a class="p-0 logo-container" href="{{ route('home') }}">
                    <img src="/img/logos/logo_circle.png" alt="mobile hood logo">
                </a>
            </div>
            <div class="d-flex align-items-center pointer">
                <i class="bx bx-share-alt fs-3 me-3 fw-medium opacity-75"></i>
                <i class="bx bx-info-circle fs-3 fw-medium opacity-75" data-bs-toggle="modal"
                    data-bs-target="#modal"></i>

                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="fw-semibold" id="modalLabel">Información</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span id="lat" class="d-none">{{ $buisness->location->lat }}</span>
                                <span id="lng" class="d-none">{{ $buisness->location->lng }}</span>
                                <div class="map-container mb-3">
                                    <div id="map"></div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div class="modal-logo-container border border-dark rounded-2 me-2">
                                        <img src="{{ $buisness->getImageUrl() }}" alt="{{ $buisness->name }} logo"
                                            class="img-fluid rounded-2">
                                    </div>
                                    <div>
                                        <div class="d-inline rating rounded-1">
                                            <i class="bx bxs-star ms-1 pt-1"></i>
                                            <span class="fw-medium me-1">
                                                {{ number_format(rand(37, 47) / 10, 1) }}
                                            </span>
                                        </div>
                                        <p class="fw-medium opacity-75">Envío gratis</p>
                                    </div>
                                </div>
                                <h5 class="fw-semibold">Formas de pago</h5>
                                <p class="fw-semibold my-3">Online</p>
                                <div class="bmrUML iUDdTV mb-4">
                                    <img aria-label="Visa"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-visa.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="Mastercard"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-mastercard.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="Cabal Débito"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-cabal.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="American Express"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-american-express.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="Naranja"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-naranja.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="Nevada"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-nevada.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="Nativa"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-nativa.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="CMR Falabella"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-cmr-falabella.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="Walmart"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-walmart.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                    <img aria-label="Cordobesa"
                                        src="https://pedidosya.dhmedia.io/image/pedidosya/payment-methods/online-payments/profile/pay-cordobesa.png?quality=70&amp;width=100"
                                        class="hJzIXA">
                                </div>
                                <p class="fw-semibold mb-3">En la entrega</p>
                                <img aria-label="Efectivo"
                                    src="data:image/png;base64,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"
                                    class="sc-basr2n-0 hJzIXA mb-5">
                                <h5 class="fw-semibold">Horarios</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="lg-footer">
        <div class="d-flex justify-content-between border-bottom border-light border-2 border-opacity-75 mb-4 pb-4">
            <div>
                <img src="/img/logos/logo_circle.png" alt="">
                <h5 class="text-light">{{ __('messages.slogan') }}</h5>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('partners') }}" class="text-decoration-none text-light">
                    {{ __('Partner Portal') }}
                </a>
                <p class="m-0 ms-2 text-light">|</p>
                <a href="" class="ms-2 text-decoration-none text-light">{{ __('messages.yt_link') }}</a>
            </div>
        </div>
        <p class="text-light">{{ __('messages.rights') }}</p>
    </footer>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ $maps }}&callback=initMap&libraries=marker" async
        defer></script>
    <script src="/js/Google/mapInfo.js"></script>

    @yield('scripts')
</body>

</html>
