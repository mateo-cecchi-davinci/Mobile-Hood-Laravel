@extends('layouts.appLayout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col col-md-6">{{ __('messages.details') }}</div>
                            <div class="col col-md-6">
                                <a href="{{ route('orders.index') }}" class="btn btn-success btn-sm float-end">{{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <ul>
                                    <li>{{ __('messages.payment') }}: {{ $order->payment }}</li>
                                    <li>{{ __('messages.state') }}: {{ $order->state }}</li>
                                    <li>{{ __('messages.user') }}: {{ $order->user->email }}</li>
                                    <li>{{ __('messages.date') }}: {{ $order->created_at }}</li>
                                    <li>
                                        <p class="m-0">{{ __('messages.sold_products') }}:</p>
                                        <ul>
                                            @foreach ($order->products()->get() as $product)
                                                <li>{{ $product->model . ' | {{ __('messages.amount') }}: ' . $product->pivot->amount }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
