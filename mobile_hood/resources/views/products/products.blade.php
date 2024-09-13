@extends('layouts.appLayout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center py-5">
        <div class="col-8 col-sm-9 col-md-10 py-5">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col col-md-6">{{ __('messages.products') }}</div>
                        <div class="col col-md-6">
                            <a href="{{ route('products.create') }}"
                                class="btn btn-success btn-sm float-end">{{ __('messages.add') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body overflow-x-scroll">
                    <table id="table" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>{{ __('messages.model') }}</td>
                                <td>{{ __('messages.brand') }}</td>
                                <td>{{ __('messages.price') }}</td>
                                <td>{{ __('messages.category') }}</td>
                                <td>{{ __('messages.image') }}</td>
                                <td>{{ __('messages.actions') }}</td>
                            </tr>
                        </thead>
                        @if (count($products) > 0)
                            <tbody>
                                @foreach ($products as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->model }}</td>
                                        <td>{{ $p->brand }}</td>
                                        <td>{{ $p->price }}</td>
                                        <td>{{ $p->category->name }}</td>
                                        <td>{{ $p->image }}</td>
                                        <form method="post"
                                            action="{{ route('products.destroy', ['product' => $p->id]) }}"
                                            class="row px-3">
                                            @csrf
                                            @method('DELETE')
                                            <div class="dropstart">
                                                <div role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded bx-fw opacity-75"></i>
                                                </div>
                                                <ul class="dropdown-menu dropdown-menu-end" data-bs-theme="dark">
                                                    <li>
                                                        <a href="{{ route('products.show', ['product' => $p->id]) }}"
                                                            class="dropdown-item fs-6">
                                                            {{ __('messages.show') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('products.edit', ['product' => $p->id]) }}"
                                                            class="dropdown-item fs-6">
                                                            {{ __('messages.edit') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <input type="submit" class="dropdown-item fs-6"
                                                            value="{{ __('messages.delete') }}">
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = new DataTable('#table', {
            language: {
                // url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            },
        });
    </script>
@endsection
