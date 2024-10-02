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
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css" />

    <link rel="stylesheet" href="/css/sidebar/styles.css">
    <link rel="stylesheet" href="/css/layout/app/styles.css">
    <link rel="stylesheet" href="/css/home/styles.css">

    <title>{{ config('app.name', 'Mobile Hood') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('styles')
</head>

<body>

    <nav
        class="d-flex d-lg-none border-bottom bg-white justify-content-between align-items-center sm-nav user-select-none">
        <a class="p-0 sm-logo-container" href="{{ route('home') }}">
            <img src="/img/logos/logo_circle.png" alt="mobile hood logo">
        </a>
        <a href="{{ route('partners') }}" class="text-decoration-none text-light bg-red p-2 rounded" type="button">
            {{ __('messages.become_partner_btn') }}
        </a>
    </nav>

    <nav class="navbar navbar-expand py-0 d-none d-lg-block border-bottom lg-nav user-select-none bg-white">
        <div class="container-fluid">
            <a class="p-0 logo-container" href="{{ route('home') }}">
                <img src="/img/logos/logo_circle.png" alt="mobile hood logo">
            </a>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @guest
                    <li class="nav-item ms-3">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">
                            {{ __('messages.login') }}
                        </a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link active" aria-current="page" href="{{ route('register') }}">
                            {{ __('messages.signin') }}
                        </a>
                    </li>
                @else
                    <li class="pointer profile-dropdown">
                        <div class="dropdown">
                            <div class="d-flex justify-content-between align-items-center fw-medium"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span>
                                    {{ Auth::user()->name }}
                                </span>
                                <i class="bx bx-chevron-down bx-fw"></i>
                            </div>
                            <ul class="dropdown-menu fw-medium border-top-0 rounded-top-0">
                                <li class="d-flex align-items-center mb-4">
                                    <i class="bx bx-home bx-fw icon ms-2 fs-3"></i>
                                    <a class="text-decoration-none text-dark" href="{{ route('home') }}">Inicio</a>
                                </li>
                                <li class="d-flex align-items-center mb-4">
                                    <i class="bx bx-heart bx-fw icon ms-2 fs-3"></i>
                                    <a class="text-decoration-none text-dark" href="#">Mis favoritos</a>
                                </li>
                                <li class="d-flex align-items-center mb-4">
                                    <i class="bx bx-detail bx-fw icon ms-2 fs-3"></i>
                                    <a class="text-decoration-none text-dark" href="#">Mis pedidos</a>
                                </li>
                                <li class="d-flex align-items-center mb-4">
                                    <i class="bx bx-user bx-fw icon ms-2 fs-3"></i>
                                    <a class="text-decoration-none text-dark" href="{{ route('profile') }}">
                                        Mi perfil
                                    </a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bx bx-exit bx-fw icon ms-2 fs-3"></i>
                                    <a class="text-decoration-none text-dark" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endguest
                <li class="nav-item ms-3">
                    <a href="{{ route('partners') }}" class="text-decoration-none text-light bg-red p-2 rounded"
                        type="button">
                        {{ __('messages.become_partner_btn') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="text-decoration-none dropdown-toggle text-light ms-3 bg-red p-2 rounded"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Config::get('languages')[App::getLocale()] }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <li class="dropdown-item">
                                    <a href="{{ route('lang.switch', $lang) }}" class="text-decoration-none text-dark">
                                        {{ $language }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    @guest
    @else
        @if (Auth::user()->is_admin)
            <div class="sidebar fixed-top user-select-none">
                <div class="profile">
                    <div class="logo_details pt-4">
                        <i class="bx bx-planet icon text-light"></i>
                        <div class="logo_name text-light">{{ __('messages.logo_name') }}</div>
                        <i id="btn"></i>
                    </div>
                </div>
                <div data-simplebar class="sidebar-content">
                    <div class="profile_details text-light">
                        <div class="profile_content">
                            <div class="name">{{ Auth::user()->name }}</div>
                            <div class="designation">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="user-img">
                            <img src="/img/inicial_nombre.png" alt="Foto de perfil" class="img-fluid">
                            <div class="first-letter">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                    <ul class="p-0 mt-5 ms-3">
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="bx bxs-home mt-1"></i>
                                <span class="link_name">{{ __('messages.home') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}">
                                <i class="bx bxs-category mt-1"></i>
                                <span class="link_name">{{ __('messages.categories') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}">
                                <i class="bx bxs-shopping-bag mt-1"></i>
                                <span class="link_name">{{ __('messages.products') }}</span>
                            </a>
                        </li>
                        <div class="line"></div>
                        <li>
                            <a href="{{ route('buisnesses.index') }}">
                                <i class="bx bxs-store mt-1"></i>
                                <span class="link_name">{{ __('messages.buisnesses') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('locations.index') }}">
                                <i class="bx bxs-map mt-1"></i>
                                <span class="link_name">Ubicaciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('orders.index') }}">
                                <i class="bx bxs-cart mt-1"></i>
                                <span class="link_name mt-1">{{ __('messages.orders') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}">
                                <i class="bx bxs-user mt-1"></i>
                                <span class="link_name">{{ __('messages.users') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    @endguest

    <main class="user-select-none">
        @yield('content')
    </main>

    {{--    ARREGLAR LOS FORMULARIOS DE LAS ORDENES    --}}

    @if (!empty($orders))
        <form action="{{ route('user-orders') }}" method="POST">
            @csrf
            @foreach ($orders as $order)
                <input type="hidden" name="orders[]" value="{{ $order['id'] }}">
            @endforeach
            <button type="submit" class="fw-semibold d-flex align-items-center order-link user-select-none border-0">
                <h3 class="me-1 mb-0">
                    Ir a mi pedido
                </h3>
                <i class="bx bx-chevrons-right fs-1 order-link-open-btn"></i>
            </button>
        </form>
    @endif

    <footer class="d-none d-lg-block lg-footer user-select-none">
        <div class="d-flex justify-content-between border-bottom border-light border-2 border-opacity-75 mb-4 pb-4">
            <div>
                <img src="/img/logos/logo_circle.png" alt="logo de mobile hood">
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

    <footer class="sticky-bottom d-block d-lg-none p-3 pt-4 bg-body-tertiary border-top top-shadow user-select-none">
        <div class="d-flex justify-content-between align-items-center p-1 container">
            <form method="GET" action="{{ route('home') }}">
                @csrf
                <button type="submit" class="border-0 bg-transparent text-dark fw-semibold opacity-75">
                    <div class="d-flex flex-column align-items-center">
                        <i class="bx bx-home bx-fw fs-2 nav-icon mb-1"></i>
                    </div>
                    Inicio
                </button>
            </form>
            <form method="GET" action="#">
                @csrf
                <button type="submit" class="border-0 bg-transparent text-dark fw-semibold opacity-75">
                    <div class="d-flex flex-column align-items-center">
                        <i class="bx bx-heart bx-fw fs-2 nav-icon mb-1"></i>
                    </div>
                    Mis favoritos
                </button>
            </form>
            <form method="POST" action="{{ route('user-orders') }}">
                @csrf
                <button type="submit" class="border-0 bg-transparent text-dark fw-semibold position-relative">
                    <div class="d-flex flex-column align-items-center">
                        <i class="bx bx-detail bx-fw fs-2 opacity-75 nav-icon mb-1 opacity-75"></i>
                    </div>
                    <span class="opacity-75">Pedidos</span>
                    @if (!empty($orders) > 0)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger pt-1">
                            {{ count($orders) }}+
                        </span>
                        @foreach ($orders as $order)
                            <input type="hidden" name="orders[]" value="{{ $order['id'] }}">
                        @endforeach
                    @endif
                </button>
            </form>
            <form method="GET" action="{{ route('profile') }}">
                @csrf
                <button type="submit" class="border-0 bg-transparent text-dark fw-semibold opacity-75">
                    <div class="d-flex flex-column align-items-center">
                        <i class="bx bx-user bx-fw fs-2 nav-icon mb-1"></i>
                    </div>
                    Mi perfil
                </button>
            </form>
        </div>
    </footer>

    <script src="/js/components/sidebar.js"></script>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
    <script src="/js/components/inputs/searchBuisness.js"></script>

    @yield('scripts')
</body>

</html>
