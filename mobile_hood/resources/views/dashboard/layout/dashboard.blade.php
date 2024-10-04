<!DOCTYPE html>
<html lang="es">

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

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css" />

    <link rel="stylesheet" href="/css/dashboard/styles.css">
    <link rel="stylesheet" href="/css/dashboard/menu/styles.css">
    <link rel="stylesheet" href="/css/dashboard/sidebar/styles.css">
    <link rel="stylesheet" href="/css/dashboard/navbar/styles.css">

    <title>{{ config('app.name', 'Mobile Hood') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body class="user-select-none bg-body-tertiary">

    @include('dashboard.layout.navbar.nav')

    @include('dashboard.layout.sidebar.sidebar')

    <main>
        @yield('content')
    </main>

    <script src="/js/components/sidebar.js"></script>
    <script src="/js/dashboard/menu.js"></script>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

</body>

</html>
