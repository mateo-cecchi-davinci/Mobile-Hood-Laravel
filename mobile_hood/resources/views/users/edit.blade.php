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
    <div class="row justify-content-center align-items-center w-100" style="height: 100vh;">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col col-md-6">{{ __('messages.edit_user') }}</div>
                        <div class="col col-md-6">
                            <a href="{{ route('users.index') }}"
                                class="btn btn-success btn-sm float-end">{{ __('messages.back') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-label-form">{{ __('messages.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-label-form">{{ __('messages.lastname') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-label-form">{{ __('messages.email') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-label-form">{{ __('messages.phone') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}"
                                    required>
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

@endsection
