<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/layouts/partnerLayout/styles.css">

    <title>{{ config('app.name', 'Socios Mobile Hood') }}</title>
    @yield('styles')
</head>
<body>
    <nav>
        <h1>Mobile Hood Partner</h1>
        <div>
          <a href="" class="nav-items fw-semibold">¿Cómo funcionamos?</a>
          <a href="" class="nav-items fw-semibold">Preguntas Frecuentes</a>
          <button class="nav-button fw-semibold">Ir a Partner Portal</button>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer>
      <div class="footer-fist-child">
        <div>
          <h3 class="logo-slogan">Mobile Hood Partner</h3>
          <h5 class="logo-slogan">Crezcamos juntos</h5>
        </div>
        <div style="display: flex;  align-items: center;">
          <a href="" style="margin-right: 10px; color: #2b2c34; text-decoration: none;  font-size: 13px;">Partner Portal</a>
          <p style="margin-right: 10px; color: #2b2c34; font-size: 13px;">|</p>
          <a href="" style=" color: #2b2c34; text-decoration: none;  font-size: 13px;">Canal de Youtube</a>
        </div>
      </div>
      <p class="footer-second-child">©2024 Mobile Hood. Todos los derechos reservados.</p>
    </footer>
    @yield('scripts')
</body>
</html>
