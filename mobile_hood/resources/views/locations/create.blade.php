@extends('layouts.appLayout')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center mt-5 pt-5">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col col-md-6">Agregar Ubicación</div>
                            <div class="col col-md-6">
                                <a href="{{ route('locations.index') }}" class="btn btn-success btn-sm float-end">
                                    {{ __('messages.back') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="map-container mb-5">
                            <div id="map"></div>
                        </div>
                        <form method="post" action="{{ route('locations.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-sm-2 col-label-form">Negocio</label>
                                <div class="col-sm-10">
                                    <select name="business[]" class="form-select">
                                        <option value="" selected>Seleccione un negocio</option>
                                        @foreach ($businesses as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="lng" name="lng">
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="{{ __('messages.add') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ $maps }}&callback=initMap&libraries=marker" async
        defer></script>
    <script src="/js/Google/maps.js"></script>
@endsection
