<nav class="navbar navbar-expand scroll p-0">
    <div class="d-none d-lg-block w-100 bg-white second-nav">
        @include('components.navs.businessProfile.scroll.content.lg', [
            'id' => $id,
        ])
    </div>
    <div class="d-block d-lg-none w-100 bg-white second-nav">
        @include('components.navs.businessProfile.scroll.content.sm', [
            'name' => $name,
            'productsByCategory' => $productsByCategory,
            'categories' => $categories,
        ])
    </div>
</nav>

<script src="/js/components/secondNav.js"></script>
