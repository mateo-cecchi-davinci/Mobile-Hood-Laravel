@extends('layouts.appLayout')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center mt-5 pt-5">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col col-md-6">{{ __('messages.details') }}</div>
                            <div class="col col-md-6">
                                <a href="{{ route('categories.index') }}"
                                    class="btn btn-success btn-sm float-end">{{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <img src="{{ $buisness->getImageURL() }}" alt="logo" class="col-sm-12">
                            </div>
                            <div class="col-sm-10">
                                <ul>
                                    <li>{{ __('messages.name') }}: {{ $buisness->name }}</li>
                                    <li>{{ __('messages.street') }}: {{ $buisness->street }}</li>
                                    <li>{{ __('messages.number') }}: {{ $buisness->number }}</li>
                                    <li>{{ __('messages.category') }}: {{ __('messages.' . $buisness->category) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
