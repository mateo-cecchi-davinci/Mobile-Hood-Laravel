<nav class="navbar navbar-expand bg-white p-0 mb-5 border-bottom">
    <div class="d-flex align-items-center my-2 me-4">
        <form action="{{ route('business', ['business' => $business]) }}" method="POST">
            @csrf
            <button class="border-0 bg-transparent" type="submit">
                <i class="bx bx-chevron-left text-dark pt-1 back-btn me-3"></i>
            </button>
        </form>
        <div class="p-0 logo-container">
            <img src="/img/logos/logo_circle.png" alt="mobile hood logo" class="img-fluid">
        </div>
    </div>
</nav>
