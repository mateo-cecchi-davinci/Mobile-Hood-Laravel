@extends('layouts.appLayout')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card col-10">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col col-md-6">{{ __('messages.details') }}</div>
                    <div class="col col-md-6">
                        <a href="{{ route('products.index') }}" class="btn btn-sm float-end text-light"
                            style="background-color: #ae0876;">{{ __('messages.back') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <ul>
                            <li>{{ __('messages.model') }}: {{ $product->model }}</li>
                            <li>{{ __('messages.brand') }}: {{ $product->brand }}</li>
                            <li>{{ __('messages.description') }}: {{ $product->description }}</li>
                            <li>{{ __('messages.price') }}: {{ $product->price }}</li>
                            <li>{{ __('messages.category') }}: {{ $product->category->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
