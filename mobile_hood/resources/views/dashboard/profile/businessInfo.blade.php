@extends('dashboard.layout.dashboard')
@section('content')
    <div class="container" style="max-width: 1000px;">
        <div class="d-flex align-items-center mt-5 mb-4">
            <a href="{{ route('partner-profile') }}" class="text-decoration-none text-dark">
                <i class="bx bx-chevron-left bx-md me-2"></i>
            </a>
            <h1 class="m-0 p-0 fw-medium">Datos del negocio</h1>
        </div>
        <form action="{{ route('edit-business') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white px-3 py-4 shadow">
                <p class="m-0 mb-2 p-0 opacity-75 fw-medium lh-1">Nombre*</p>
                <input type="text" name="name" class="form-control" value="{{ $business->name }}" required>
                <p class="m-0 mt-3 mb-2 p-0 opacity-75 fw-medium lh-1">Calle*</p>
                <input type="text" name="street" class="form-control" value="{{ $business->street }}" required>
                <p class="m-0 mt-3 mb-2 p-0 opacity-75 fw-medium lh-1">Número*</p>
                <input type="number" name="number" class="form-control" value="{{ $business->number }}" required>
                <div class="d-flex align-items-center my-3">
                    <div style="width: 150px;">
                        <img class="img-fluid" src="{{ $business->getImageURL() }}" alt="logo">
                    </div>
                    <div class="ms-3 w-100">
                        <p class="m-0 mb-2 p-0 opacity-75 fw-medium lh-1">Logo*</p>
                        <input type="file" name="logo" class="form-control" value="{{ $business->logo }}">
                    </div>
                </div>
                <div class="d-flex align-items-center my-3">
                    <div style="width: 150px;">
                        <img class="img-fluid" src="{{ $business->getFrontPageURL() }}" alt="portada">
                    </div>
                    <div class="ms-3 w-100">
                        <p class="m-0 mb-2 p-0 opacity-75 fw-medium lh-1">Portada*</p>
                        <input type="file" name="frontPage" class="form-control" value="{{ $business->frontPage }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="edit-pi-btn text-white fw-semibold my-4 w-100 p-3 rounded-2">
                Guardar cambios
            </button>
        </form>
    </div>
@endsection
