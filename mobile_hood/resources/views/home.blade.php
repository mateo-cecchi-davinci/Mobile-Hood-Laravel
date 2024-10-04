@extends('layouts.appLayout')

@section('content')
    <div class="home-container bg-body-tertiary py-4">
        @include('components.inputs.businesses')

        <div id="businesses">
            @include('components.businesses', [
                'businesses' => $businesses,
            ])
        </div>
    </div>
@endsection
