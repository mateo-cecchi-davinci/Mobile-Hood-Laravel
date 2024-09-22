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
                        <div class="col col-md-6">Ubicaciones</div>
                        <div class="col col-md-6">
                            <a href="{{ route('locations.create') }}"
                                class="btn btn-success btn-sm float-end">{{ __('messages.add') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Negocio</td>
                                <td>Latitud</td>
                                <td>Longitud</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        @if (count($locations) > 0)
                            <tbody>
                                @foreach ($locations as $l)
                                    <tr>
                                        <td>{{ $l->id }}</td>
                                        <td>{{ $l->buisness->name }}</td>
                                        <td>{{ $l->lat }}</td>
                                        <td>{{ $l->lng }}</td>
                                        <td>
                                            <form method="post"
                                                action="{{ route('locations.destroy', ['location' => $l->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('locations.show', ['location' => $l->id]) }}"
                                                    class="btn btn-primary btn-sm">{{ __('messages.show') }}</a>
                                                <a href="{{ route('locations.edit', ['location' => $l->id]) }}"
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
