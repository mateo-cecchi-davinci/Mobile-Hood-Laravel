@extends('dashboard.layout.dashboard')
@section('content')
    <div class="container" style="max-width: 1000px;">
        <h1 class="mt-5 mb-4 p-0 fw-medium">Mi cuenta</h1>
        <p class="m-0 ms-3 p-0 fw-semibold fs-5">Perfil</p>
        <a href="{{ route('personal-info') }}"
            class="d-flex justify-content-between align-items-center bg-white p-3 text-decoration-none text-dark">
            <div class="d-flex align-items-center">
                <i class="bx bx-user opacity-75 me-2" style="font-size: 20px;"></i>
                <p class="fw-medium m-0 p-0">Información personal</p>
            </div>
            <i class="bx bx-chevron-right bx-sm"></i>
        </a>
        <p class="m-0 mt-3 ms-3 p-0 fw-semibold fs-5">Perfil de mi negocio</p>
        <a href="{{ route('business-info') }}"
            class="d-flex justify-content-between align-items-center bg-white p-3 text-decoration-none text-dark">
            <div class="d-flex align-items-center">
                <i class="bx bx-store opacity-75 me-2" style="font-size: 20px;"></i>
                <p class="fw-medium m-0 p-0">Información del negocio</p>
            </div>
            <i class="bx bx-chevron-right bx-sm"></i>
        </a>
        <p class="m-0 mt-3 ms-3 p-0 fw-semibold fs-5">Soporte</p>
        <div class="d-flex justify-content-between align-items-center bg-white p-3 mb-1">
            <div class="d-flex align-items-center">
                <i class="bx bx-info-circle opacity-75 me-2" style="font-size: 20px;"></i>
                <p class="fw-medium m-0 p-0">Términos y condiciones</p>
            </div>
            <i class="bx bx-chevron-right bx-sm"></i>
        </div>
        <div class="d-flex justify-content-between align-items-center bg-white p-3">
            <div class="d-flex align-items-center">
                <i class="bx bx-lock opacity-75 me-2" style="font-size: 20px;"></i>
                <p class="fw-medium m-0 p-0">Políticas de privacidad</p>
            </div>
            <i class="bx bx-chevron-right bx-sm"></i>
        </div>
        <a href="{{ route('logout') }}"
            onclick="
                event.preventDefault(); 
                document.getElementById('logout-form').submit();"
            class="text-decoration-none text-dark">
            <div class="d-flex justify-content-between align-items-center bg-white p-3 mt-5">
                <div class="d-flex align-items-center">
                    <i class="bx bx-exit opacity-75 me-2 bx-fw" style="font-size: 20px;"></i>
                    <span class="fw-medium">Cerrar sesión</span>
                </div>
                <i class="bx bx-chevron-right bx-sm"></i>
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@endsection
