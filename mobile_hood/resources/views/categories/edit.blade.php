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
                            <div class="col col-md-6">{{ __('messages.edit_category') }}</div>
                            <div class="col col-md-6">
                                <a href="{{ route('categories.index') }}"
                                    class="btn btn-success btn-sm float-end">{{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('categories.update', $category) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.name') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-sm-2 col-label-form">{{ __('messages.parent_category') }}</label>
                                <div class="col-sm-10">
                                    <select name="categories[]" class="form-select" aria-label="Default select example">
                                        <option value="" selected>{{ __('messages.select_category') }}</option>
                                        @foreach ($categories as $c)
                                            @if ($category->parent != null)
                                                {
                                                <option @selected($c->id == $category->parent->id) value="{{ $c->id }}">
                                                    {{ $c->name }}</option>
                                                }
                                            @else
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="{{ __('messages.update') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
