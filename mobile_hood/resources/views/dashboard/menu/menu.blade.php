@extends('dashboard.layout.dashboard')
@section('content')
    @if ($errors->any())
        <div class="container">
            <div class="pt-5">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white p-4 border container my-5 d-lg-flex">
        @include('dashboard.menu.menu-content', [
            'data' => $data,
        ])
    </div>
@endsection
