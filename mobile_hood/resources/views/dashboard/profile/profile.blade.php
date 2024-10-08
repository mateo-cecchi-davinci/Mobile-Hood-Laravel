@extends('dashboard.layout.dashboard')
@section('content')
    <div class="header-container" style="background-image: url({{ $business->getFrontPageURL() }});">
        <div class="header">
            <form class="w-100 h-100 d-flex justify-content-center align-items-center" action="{{ route('edit-frontPage') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="fileInput" name="frontPage" class="d-none">

                <button type="button" class="border-0 bg-transparent text-light d-flex" id="triggerFileInput">
                    <h1 role="button" class="m-0 fw-semibold me-3">Elegí tu foto de portada</h1>
                    <i role="button" class="bx bx-edit bx-lg"></i>
                </button>

                <button type="submit" id="submitBtn" class="d-none"></button>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center px-3 pt-5 pb-3">
        <div class="frontPage-conditions border border-dark shadow rounded-2 bg-white p-4">
            <h5 class="m-0 mb-2">
                Porfavor tené en cuenta los siguientes puntos para que podamos aprobar la imagen de tu portada:
            </h5>
            <div class="d-flex align-items-center mt-4 opacity-75">
                <i class="bx bxs-circle me-2 dot"></i>
                <p class="m-0">Tiene que tener el ancho entre 1080px y 1440px</p>
            </div>
            <div class="d-flex align-items-center opacity-75">
                <i class="bx bxs-circle me-2 dot"></i>
                <p class="m-0">Tiene que tener el alto entre 412px y 720px</p>
            </div>
            <div class="d-flex align-items-center opacity-75">
                <i class="bx bxs-circle me-2 dot"></i>
                <p class="m-0">El formato tiene que ser: jpg, png, jpeg, webp</p>
            </div>

            <h5 class="m-0 mt-5 mb-3">
                Editá tu logo y el nombre de tu negocio
            </h5>

            <div class="d-flex align-items-start">
                <div class="border border-dark rounded-2 business-logo-container me-3"
                    style="background-image: url({{ $business->getImageURL() }});">
                    <form action="{{ route('edit-logo') }}" method="POST" enctype="multipart/form-data"
                        class="edit-logo-form">
                        @csrf
                        <input type="file" id="fileLogoInput" name="logo" class="d-none">

                        <div class="logo d-flex justify-content-center align-items-center" id="triggerFileLogoInput">
                            <i class="bx bx-edit text-light edit-logo bx-md"></i>
                        </div>

                        <button type="submit" id="submitLogoBtn" class="d-none"></button>
                    </form>
                </div>
                <div class="d-flex flex-column">
                    <form action="{{ route('edit-name') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input class="fw-semibold fs-5 w-100 ps-2" type="text" name="name"
                            value="{{ $business->name }}">
                        <button type="submit" class="border-0 bg-transparent">
                            <i class="bx bx-edit bx-sm pt-1"></i>
                        </button>
                    </form>
                    <div class="d-flex opacity-75 lh-1 mt-3">
                        <i class="bx bxs-circle me-2 dot"></i>
                        <p class="m-0">El aspecto de tu logo tiene que ser 1:1</p>
                    </div>
                    <div class="d-flex opacity-75 lh-1 mt-2">
                        <i class="bx bxs-circle me-2 dot"></i>
                        <p class="m-0">El formato tiene que ser: jpg, png, jpeg, webp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
