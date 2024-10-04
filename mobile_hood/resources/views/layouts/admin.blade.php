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
                <a href="{{ route('businesses.index') }}">
                    <i class="bx bxs-store mt-1"></i>
                    <span class="link_name">{{ __('messages.businesses') }}</span>
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
