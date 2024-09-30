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

    <link rel="stylesheet" href="/css/layout/order/styles.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>{{ config('app.name', 'Mobile Hood') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('styles')
</head>

<body>
    @include('components.navs.order.nav')

    <main class="user-select-none">
        @yield('content')
    </main>

    <footer class="fixed-bottom red-bg">
        <div class="text-center text-light py-3 lh-sm sm-font">
            <p class="m-0">MobileHood © 2023-2024</p>
            <p class="m-0">v4.1.64</p>
        </div>
    </footer>

    @yield('scripts')
</body>

</html>
