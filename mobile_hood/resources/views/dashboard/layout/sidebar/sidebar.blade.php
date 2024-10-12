<div class="sidebar fixed-top user-select-none border-end">
    <div class="profile">
        <div class="logo_details pt-4">
            <div class="p-0 logo-container">
                <img src="/img/logos/logo_circle.png" alt="mobile hood logo" class="img-fluid">
            </div>
            <div class="logo_name text-light ps-3">Dashboard</div>
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
                    <span class="link_name">Inicio</span>
                </a>
            </li>
            <li>
                <a href="{{ route('partner-profile') }}">
                    <i class="bx bxs-store mt-1"></i>
                    <span class="link_name">Perfil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="bx bxs-food-menu mt-1"></i>
                    <span class="link_name">Menú</span>
                </a>
            </li>
            <li>
                <a href="{{ route('orders') }}">
                    <i class="bx bxs-shopping-bag mt-1"></i>
                    <span class="link_name mt-1">Pedidos en curso</span>
                </a>
            </li>
            <li>
                <a href="{{ route('recent-orders') }}">
                    <i class="bx bx-revision bx-sm mt-1"></i>
                    <span class="link_name mt-1">Pedidos recientes</span>
                </a>
            </li>
            <div class="line"></div>
            <li>
                <a href="{{ route('hours') }}">
                    <i class="bx bxs-alarm mt-1"></i>
                    <span class="link_name">Horarios</span>
                </a>
            </li>
            <li>
                <a href="{{ route('location') }}">
                    <i class="bx bxs-map mt-1"></i>
                    <span class="link_name">Ubicación</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="bx bxs-user mt-1"></i>
                    <span class="link_name">Info personal</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bxs-exit mt-1"></i>
                    <span class="link_name">Cerrar sesión</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
