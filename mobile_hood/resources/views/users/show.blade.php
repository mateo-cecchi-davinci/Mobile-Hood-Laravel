@extends('layouts.appLayout')

@section('content')
    <div class="row justify-content-center align-items-center pt-5 w-100" style="height: 100vh;">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col col-md-6">{{ __('messages.details') }}</div>
                        <div class="col col-md-6">
                            <a href="{{ route('users.index') }}"
                                class="btn btn-success btn-sm float-end">{{ __('messages.back') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <ul>
                                <li>{{ __('messages.name') }}: {{ $user->name }}</li>
                                <li>{{ __('messages.lastname') }}: {{ $user->lastname }}</li>
                                <li>{{ __('messages.email') }}: {{ $user->email }}</li>
                                <li>{{ __('messages.phone') }}: {{ $user->phone }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
