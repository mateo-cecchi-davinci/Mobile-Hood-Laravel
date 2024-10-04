@extends('layouts.appLayout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

    <div class="d-flex justify-content-center align-items-center py-5">
        <div class="col-10 col-xl-9 py-5">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col col-md-6">{{ __('messages.businesses') }}</div>
                        <div class="col col-md-6">
                            <a href="{{ route('businesses.create') }}"
                                class="btn btn-success btn-sm float-end">{{ __('messages.add') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body overflow-x-auto">
                    <table id="table" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>{{ __('messages.name') }}</td>
                                <td>{{ __('messages.street') }}</td>
                                <td>{{ __('messages.number') }}</td>
                                <td>{{ __('messages.category') }}</td>
                                <td>{{ __('messages.owner') }}</td>
                                <td>{{ __('messages.actions') }}</td>
                            </tr>
                        </thead>
                        @if (count($businesses) > 0)
                            <tbody>
                                @foreach ($businesses as $b)
                                    <tr>
                                        <td>{{ $b->id }}</td>
                                        <td>{{ $b->name }}</td>
                                        <td>{{ $b->street }}</td>
                                        <td>{{ $b->number }}</td>
                                        <td>{{ $b->category }}</td>
                                        <td>{{ $b->user->email }}</td>
                                        <td>
                                            <form method="post"
                                                action="{{ route('businesses.destroy', ['business' => $b->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('businesses.show', ['business' => $b->id]) }}"
                                                    class="btn btn-primary btn-sm">{{ __('messages.show') }}</a>
                                                <a href="{{ route('businesses.edit', ['business' => $b->id]) }}"
                                                    class="btn btn-warning btn-sm">{{ __('messages.edit') }}</a>
                                                <input type="submit" class="btn btn-danger btn-sm"
                                                    value="{{ __('messages.delete') }}">
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
            // language: {
            //     url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            // },
        });
    </script>
@endsection
