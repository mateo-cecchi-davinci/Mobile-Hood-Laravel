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
                            <div class="col col-md-6">{{ __('messages.add_buisness') }}</div>
                            <div class="col col-md-6">
                                <a href="{{ route('buisnesses.index') }}"
                                    class="btn btn-success btn-sm float-end">{{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('buisnesses.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.name') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.logo') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" name="logo" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.street') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="street" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.number') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" name="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-sm-2 col-label-form">{{ __('messages.owner') }}</label>
                                <div class="col-sm-10">
                                    <select name="users[]" class="form-select">
                                        <option value="" selected>{{ __('messages.select_user') }}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-sm-2 col-label-form">{{ __('messages.category') }}</label>
                                <div class="col-sm-10">
                                    <select name="categories[]" class="form-select" aria-label="Default select example">
                                        <option value="" selected>{{ __('messages.select_category') }}</option>
                                        <option value="butcher_shop">{{ __('messages.butcher_shop') }}</option>
                                        <option value="grocery_store">{{ __('messages.grocery_store') }}
                                        </option>
                                        <option value="winery">{{ __('messages.winery') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="{{ __('messages.add') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
