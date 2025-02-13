@extends('dashboard.layout.dashboard')
@section('content')
    <div class="container" style="max-width: 1000px;">
        <div class="d-flex align-items-center mt-5 mb-4">
            <a href="{{ route('partner-profile') }}" class="text-decoration-none text-dark">
                <i class="bx bx-chevron-left bx-md me-2"></i>
            </a>
            <h1 class="m-0 p-0 fw-medium">Información personal</h1>
        </div>
        <a href="{{ route('edit-personal-info') }}"
            class="d-flex justify-content-between align-items-center bg-white p-3 text-decoration-none text-dark">
            <div>
                <p class="m-0 p-0 fw-semibold">Mis datos personales</p>
                <p class="m-0 p-0 fw-semibold opacity-75" style="font-size: 12px;">Nombre, fecha de nacimiento y género</p>
            </div>
            <i class="bx bx-chevron-right bx-md"></i>
        </a>
        <div class="d-flex justify-content-between align-items-center bg-white p-3">
            <div class="mt-3">
                <p class="m-0 p-0 fw-semibold">Número de celular</p>
                <div class="d-flex align-items-center opacity-75">
                    <i class="bx bx-check-circle me-1"></i>
                    <p class="m-0 p-0 fw-semibold" style="font-size: 12px;">+{{ Auth::user()->phone }}</p>
                </div>
            </div>
            <a href="" class="text-dark fw-semibold">Editar</a>
        </div>
        <div class="d-flex justify-content-between align-items-center bg-white p-3">
            <div class="mt-3">
                <p class="m-0 p-0 fw-semibold">Email</p>
                <div class="d-flex align-items-center opacity-75">
                    <i class="bx bx-check-circle me-1"></i>
                    <p class="m-0 p-0 fw-semibold" style="font-size: 12px;">+{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
