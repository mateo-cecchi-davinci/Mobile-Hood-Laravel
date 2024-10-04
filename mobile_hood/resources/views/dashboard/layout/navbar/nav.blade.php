<nav class="topBar border-bottom bg-white">
    <div class="display-menu-icon">
        <i class="bx bx-menu fs-1 ms-3 text-dark"></i>
    </div>
    <div class="user-navbar">
        <div class="user2-img">
            <img src="/img/inicial_nombre.png" alt="Perfil" class="img-fluid">
            <div class="first-letter">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
        <div class="text-end username-role">
            <div class="username">{{ Auth::user()->name }}</div>
            @if (Auth::user()->is_admin)
                <div class="role">Administrador</div>
            @else
                <div class="role">Partner</div>
            @endif
        </div>
    </div>
</nav>
