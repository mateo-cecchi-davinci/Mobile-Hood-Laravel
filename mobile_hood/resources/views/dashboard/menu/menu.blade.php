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
        <div id="category-section">
            @include('dashboard.menu.category-section', [
                'data' => $data,
            ])
        </div>
        <div class="w-100 products" id="category-component">
            @php
                $first = [];
                foreach ($data as $category) {
                    if ($category->hasChildren()) {
                        foreach ($category->children as $category) {
                            if ($category->products()->exists()) {
                                $first = $category;
                                break;
                            }
                        }
                        break;
                    } else {
                        $first = $category;
                        break;
                    }
                }
            @endphp
            @include('dashboard.menu.products', [
                'category' => $first,
            ])
        </div>
    </div>
@endsection
