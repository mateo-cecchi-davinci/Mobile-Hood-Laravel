@extends('layouts.appLayout')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center mt-5 pt-5">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col col-md-6">{{ __('messages.details') }}</div>
                            <div class="col col-md-6">
                                <a href="{{ route('businesses.index') }}"
                                    class="btn btn-success btn-sm float-end">{{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <img src="{{ $business->getImageURL() }}" alt="logo" class="col-sm-12">
                            </div>
                            <div class="col-sm-10">
                                <ul>
                                    <li>{{ __('messages.name') }}: {{ $business->name }}</li>
                                    <li>{{ __('messages.street') }}: {{ $business->street }}</li>
                                    <li>{{ __('messages.number') }}: {{ $business->number }}</li>
                                    <li>{{ __('messages.category') }}: {{ __('messages.' . $business->category) }}</li>
                                    <li>Horarios:</li>
                                    @foreach ($business->hours as $hours)
                                        <ul>
                                            <li>
                                                {{ $days[$hours->day_of_week] }}: {{ $hours->opening_time }} a
                                                {{ $hours->closing_time }}
                                            </li>
                                        </ul>
                                    @endforeach
                                </ul>
                                <span id="lat" class="d-none">{{ $business->location->lat }}</span>
                                <span id="lng" class="d-none">{{ $business->location->lng }}</span>
                                <div class="map-container">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ $maps }}&callback=initMap&libraries=marker" async
        defer></script>
    <script src="/js/Google/maps.js"></script>
@endsection
