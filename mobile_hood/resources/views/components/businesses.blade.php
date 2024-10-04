<p class="fw-semibold fs-5 mt-4">{{ $businesses->count() }} locales</p>

@foreach ($businesses as $business)
    <div class="card p-3 mt-3 shadow">
        <form action="{{ route('business', ['business' => $business]) }}" method="POST">
            @csrf
            <button class="border-0 w-100 bg-transparent" type="input">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="border border-dark rounded-2 business-logo-container me-3">
                            <img src="{{ $business->getImageURL() }}" alt="{{ $business->name }} logo"
                                class="img-fluid rounded-2">
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <p class="fw-semibold fs-5 m-0 p-0 me-2">{{ $business->name }}</p>
                                <i class="bx bx-heart bx-fw"></i>
                            </div>
                            <div class="d-flex align-items-center opacity-75">
                                <i class="bx bx-credit-card bx-fw icon"></i>
                                <p class="m-0 p-0">Acepta pago online</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex">
                            <i class="bx bxs-star text-warning me-1 fs-5 icon"></i>
                            <span class="fw-medium">{{ number_format(rand(37, 47) / 10, 1) }}</span>
                        </div>
                    </div>
                </div>
            </button>
        </form>
    </div>
@endforeach
