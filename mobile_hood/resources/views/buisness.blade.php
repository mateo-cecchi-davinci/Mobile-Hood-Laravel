@extends('layouts.buisnessLayout')

@section('content')
    <div class="buisness-header">
        <div class="header text-light">
            <h3>{{ $buisness->name }}</h3>
            <p class="pointer mb-1" data-bs-toggle="modal" data-bs-target="#infoModal">
                {{ $buisness->street . ' ' . $buisness->number }}
                <i class="bx bxs-map"></i>
            </p>
            <div class="d-flex align-items-center mb-3">
                <div class="d-inline rating rounded-1 me-2">
                    <i class="bx bxs-star ms-1 pt-1"></i>
                    <span class="fw-medium me-1">
                        {{ number_format(rand(37, 47) / 10, 1) }}
                    </span>
                </div>
                <p class="m-0"><small>({{ rand(700, 1200) }})</small></p>
            </div>
            <div class="row w-100">
                <div class="col col-md-6 col-lg-4">
                    <div class="d-flex align-items-center">
                        <input type="text" class="search-input border-0 col-10 ps-2" placeholder="Buscar productos...">
                        <div class="search-btn-container bg-white">
                            <button class="search-btn text-light border-0 mt-2 me-2"><i class="bx bx-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
