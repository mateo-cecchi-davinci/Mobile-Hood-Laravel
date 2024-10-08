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
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col col-md-6">{{ __('messages.edit_product') }}</div>
                            <div class="col col-md-6">
                                <a href="{{ route('products.index') }}" class="btn btn-sm float-end text-light"
                                    style="background-color: #e31010;">{{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.update', $product) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.model') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="model" class="form-control" value="{{ $product->model }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.brand') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="brand" class="form-control" value="{{ $product->brand }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.description') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control"
                                        value="{{ $product->description }}" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.price') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price" class="form-control" value="{{ $product->price }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-sm-2 col-label-form">{{ __('messages.category') }}</label>
                                <div class="col-sm-10">
                                    <select name="category[]" class="form-select"
                                        aria-label="{{ __('messages.select_category') }}" required>
                                        <option value="" selected>{{ __('messages.select_category') }}</option>
                                        @foreach ($categories as $c)
                                            <option @selected($c->id == $product->category->id) value="{{ $c->id }}">
                                                {{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">Stock</label>
                                <div class="col-sm-10">
                                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.image') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn text-light" style="background-color: #e31010;"
                                    value="{{ __('messages.update') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
