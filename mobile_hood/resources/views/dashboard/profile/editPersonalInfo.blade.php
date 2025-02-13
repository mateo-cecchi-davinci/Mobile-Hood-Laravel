@extends('dashboard.layout.dashboard')
@section('content')
    <div class="container" style="max-width: 1000px;">
        <div class="d-flex align-items-center mt-5 mb-4">
            <a href="{{ route('personal-info') }}" class="text-decoration-none text-dark">
                <i class="bx bx-chevron-left bx-md me-2"></i>
            </a>
            <h1 class="m-0 p-0 fw-medium">Mis datos personales</h1>
        </div>
        <form action="{{ route('edit-username') }}" method="POST">
            @csrf
            <div class="bg-white px-3 py-4 shadow">
                <p class="m-0 mb-2 p-0 opacity-75 fw-medium lh-1">Nombre(s)*</p>
                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                <p class="m-0 mt-5 mb-2 p-0 opacity-75 fw-medium lh-1">Apellido(s)*</p>
                <input type="text" name="lastname" class="form-control" value="{{ Auth::user()->lastname }}" required>
            </div>
            <button type="submit" class="edit-pi-btn text-white fw-semibold mt-4 w-100 p-3 rounded-2">
                Guardar cambios
            </button>
        </form>
    </div>
@endsection
