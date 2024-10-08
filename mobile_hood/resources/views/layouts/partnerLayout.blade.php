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
    <link rel="stylesheet" href="/css/partner/home/styles.css">

    <title>{{ config('app.name', 'Socios Mobile Hood') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg px-5 py-0">
        <div class="w-100 d-flex justify-content-between align-items-center px-5">
            <a class="navbar-brand p-0" href="{{ route('home') }}">
                <img src="/img/logos/partner_logo_rectangle.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item ms-3">
                        <a class="nav-link active" aria-current="page"
                            href="">{{ __('messages.how_do_we_work') }}</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link active" aria-current="page" href="">{{ __('messages.faqs') }}</a>
                    </li>
                    @guest
                        <li class="nav-item ms-3">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('login') }}">{{ __('messages.login') }}</a>
                        </li>
                        <li class="nav-item ms-3">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('register') }}">{{ __('messages.signin') }}</a>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <a class="nav-link active" aria-current="page" href="">{{ __('messages.profile') }}</a>
                        </li>
                        <li class="nav-item ms-3">
                            <a class="nav-link active" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('messages.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                    <li class="nav-item ms-3">
                        <a href="{{ route('home') }}" class="btn text-light"
                            style="background-color: #e31010;">{{ __('messages.go_back') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="btn dropdown-toggle text-light ms-3" style="background-color: #e31010;"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Config::get('languages')[App::getLocale()] }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                    <li class="dropdown-item">
                                        <a href="{{ route('lang.switch', $lang) }}"
                                            class="text-decoration-none text-dark">{{ $language }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
    <footer class="text-light" style="background-color: #e31010; padding: 2% 5%;">
        <div class="d-flex justify-content-between border-bottom border-light border-2 border-opacity-75 mb-4 pb-4">
            <div>
                <img class="mb-3" src="/img/logos/partner_logo_rectangle_borderless.png" alt="">
                <h5>{{ __('messages.slogan') }}</h5>
            </div>
            <div class="d-flex align-items-center">
                <a href="" class="text-decoration-none text-light">{{ __('Partner Portal') }}</a>
                <p class="m-0 ms-2">|</p>
                <a href="" class="ms-2 text-decoration-none text-light">{{ __('messages.yt_link') }}</a>
            </div>
        </div>
        <p>{{ __('messages.rights') }}</p>
    </footer>

    <script src="/js/components/sidebar.js"></script>

    @yield('scripts')
</body>

</html>
