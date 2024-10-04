<form class="w-100 continue" action="{{ route('order') }}" method="POST">
    @csrf
    <input type="hidden" name="user" value="{{ Auth::check() ? Auth::user()->id : '' }}">
    <input type="hidden" name="business" value="{{ $business['id'] }}">
    <input type="hidden" name="cartProducts" value="{{ json_encode($cartProducts) }}">
    <button class="w-100 border-0 text-light fw-semibold btn-order rounded-pill mt-3 mb-1 continue-btn">
        Continuar
    </button>
</form>
