@extends('layouts.appLayout')

@section('content')

    <div class="d-flex justify-content-center align-items-center py-5">
        <div class="col-md-6 py-5">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col col-md-6">{{ __('messages.categories') }}</div>
                        <div class="col col-md-6">
                            <a href="{{ route('categories.create') }}"
                                class="btn btn-success btn-sm float-end">{{ __('messages.add') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>{{ __('messages.name') }}</td>
                                <td>{{ __('messages.parent_category') }}</td>
                                <td>{{ __('messages.actions') }}</td>
                            </tr>
                        </thead>
                        @if (count($categories) > 0)
                            <tbody>
                                @foreach ($categories as $c)
                                    <tr>
                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->parent ? $c->parent->name : 'N/A' }}</td>
                                        <td>
                                            <form method="post"
                                                action="{{ route('categories.destroy', ['category' => $c->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('categories.show', ['category' => $c->id]) }}"
                                                    class="btn btn-primary btn-sm">{{ __('messages.show') }}</a>
                                                <a href="{{ route('categories.edit', ['category' => $c->id]) }}"
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
