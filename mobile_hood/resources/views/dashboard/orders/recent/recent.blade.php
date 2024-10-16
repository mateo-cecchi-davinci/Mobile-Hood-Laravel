@extends('dashboard.layout.dashboard')
@section('content')
    @livewire('recent-orders', ['business' => $business])
@endsection
