@extends('dashboard.layout.dashboard')
@section('content')
    <div class="bg-white p-4 border container my-5 d-lg-flex">
        @include('dashboard.menu.menu-content', [
            'data' => $data,
        ])
    </div>
@endsection
