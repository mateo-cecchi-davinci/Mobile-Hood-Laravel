@extends('layouts.appLayout')

@section('content')
    <div class="home-container bg-body-tertiary py-4">
        @include('components.inputs.buisnesses')

        <div id="buisnesses">
            @include('components.buisnesses', [
                'buisnesses' => $buisnesses,
            ])
        </div>
    </div>
@endsection

