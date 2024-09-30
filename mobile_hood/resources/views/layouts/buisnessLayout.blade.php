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

    @include('components.navs.buisnessProfile.header', [
        'buisnessModel' => $buisnessModel,
        'days' => $days,
        'dayIndex' => $dayIndex,
    ])

    @include('components.navs.buisnessProfile.scroll.container', [
        'id' => $buisness['id'],
        'name' => $buisness['name'],
        'productsByCategory' => $productsByCategory,
        'categories' => $categories,
    ])

    <main class="user-select-none">
        @yield('content')
    </main>

    @include('components.modals.menu', [
        'productsByCategory' => $productsByCategory,
    ])

    <footer class="lg-footer d-none d-xl-block">
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
    <script src="/js/components/input.js"></script>
    <script src="/js/components/toastMsg.js"></script>

    @yield('scripts')
</body>

</html>
