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
                            <div class="col col-md-6">{{ __('messages.edit_buisness') }}</div>
                            <div class="col col-md-6">
                                <a href="{{ route('buisnesses.index') }}"
                                    class="btn btn-success btn-sm float-end">{{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('buisnesses.update', $buisness) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.name') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" value="{{ $buisness->name }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.logo') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" name="logo" class="form-control" value="{{ $buisness->logo }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.street') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="street" class="form-control"
                                        value="{{ $buisness->street }}" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-label-form">{{ __('messages.number') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" name="number" class="form-control"
                                        value="{{ $buisness->number }}" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-sm-2 col-label-form">{{ __('messages.owner') }}</label>
                                <div class="col-sm-10">
                                    <select name="user[]" class="form-select">
                                        <option value="" selected>{{ __('messages.select_user') }}</option>
                                        @foreach ($users as $user)
                                            <option @selected($buisness->fk_buisnesses_users == $user->id) value="{{ $user->id }}">
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3 align-items-center">
                                <label class="col-sm-2 col-label-form">{{ __('messages.category') }}</label>
                                <div class="col-sm-10">
                                    <select name="category[]" class="form-select" aria-label="Default select example">
                                        <option value="" selected>{{ __('messages.select_category') }}</option>
                                        @foreach ($categories as $c)
                                            <option @selected($buisness->category == $c) value="{{ $c }}">
                                                {{ __('messages.' . $c) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Horarios
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Configurá tus horarios
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        @php
                                            $openDays = $hours->pluck('day_of_week')->toArray();
                                        @endphp
                                        <div class="modal-body">
                                            @foreach ($day as $key => $d)
                                                @php
                                                    $isOpen = in_array(array_search($d, $dayIndex), $openDays);
                                                @endphp
                                                <div class="row justify-content-start align-items-center mb-3 ps-3">
                                                    <p class="m-0 p-0 col-2 fw-medium">{{ $d }}</p>
                                                    <div class="form-check form-switch col-2">
                                                        <input name="{{ $key }}_switch" class="form-check-input"
                                                            type="checkbox" role="switch" id="{{ $key }}_switch"
                                                            {{ $isOpen ? 'checked' : '' }} data-day="{{ $key }}">
                                                        <label class="form-check-label" for="{{ $key }}_switch"
                                                            id="{{ $key }}_label">
                                                            {{ $isOpen ? 'Abierto' : 'Cerrado' }}
                                                        </label>
                                                    </div>
                                                    <div class="row-container col-8">
                                                        <div class="row align-items-center">
                                                            <div class="d-flex col-5 align-items-center">
                                                                <div class="col-6">
                                                                    <select name="{{ $key }}_open_time[]"
                                                                        id="{{ $key }}_open_time"
                                                                        class="form-select">
                                                                        @foreach ($time as $t)
                                                                            @php $flag = false; @endphp
                                                                            @foreach ($hours as $hour)
                                                                                @if ($dayIndex[$hour->day_of_week] == $d)
                                                                                    @if ($buisness->convertTo12HourFormatWithoutMeridian($hour->opening_time) == $t)
                                                                                        <option selected
                                                                                            value="{{ $t }}">
                                                                                            {{ $t }}
                                                                                        </option>
                                                                                        @php $flag = true; @endphp
                                                                                        <!-- prettier-ignore -->
                                                                                        @break
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                            @if (!$flag)
                                                                                <option value="{{ $t }}">
                                                                                    {{ $t }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-6">
                                                                    <select name="{{ $key }}_time_period_open[]"
                                                                        id="{{ $key }}_time_period_open"
                                                                        class="form-select me-2">
                                                                        @foreach ($timePeriod as $tp)
                                                                            @php $flag = false; @endphp
                                                                            @foreach ($hours as $hour)
                                                                                @if ($dayIndex[$hour->day_of_week] == $d)
                                                                                    @if ($buisness->getMeridian($hour->opening_time) == $tp)
                                                                                        <option selected
                                                                                            value="{{ $tp }}">
                                                                                            {{ $tp }}
                                                                                        </option>
                                                                                        @php $flag = true; @endphp
                                                                                        <!-- prettier-ignore -->
                                                                                        @break
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                            @if (!$flag)
                                                                                <option value="{{ $tp }}">
                                                                                    {{ $tp }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <p class="opacity-75 m-0 p-0 col-2 text-center">hasta</p>
                                                            <div class="d-flex col-5 align-items-center">
                                                                <div class="col-6">
                                                                    <select name="{{ $key }}_close_time[]"
                                                                        id="{{ $key }}_close_time"
                                                                        class="form-select">
                                                                        @foreach ($time as $t)
                                                                            @php $flag = false; @endphp
                                                                            @foreach ($hours as $hour)
                                                                                @if ($dayIndex[$hour->day_of_week] == $d)
                                                                                    @if ($buisness->convertTo12HourFormatWithoutMeridian($hour->closing_time) == $t)
                                                                                        <option selected
                                                                                            value="{{ $t }}">
                                                                                            {{ $t }}
                                                                                        </option>
                                                                                        @php $flag = true; @endphp
                                                                                        <!-- prettier-ignore -->
                                                                                        @break
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                            @if (!$flag)
                                                                                <option value="{{ $t }}">
                                                                                    {{ $t }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-6">
                                                                    <select name="{{ $key }}_time_period_close[]"
                                                                        id="{{ $key }}_time_period_close"
                                                                        class="form-select">
                                                                        @foreach ($timePeriod as $tp)
                                                                            @php $flag = false; @endphp
                                                                            @foreach ($hours as $hour)
                                                                                @if ($dayIndex[$hour->day_of_week] == $d)
                                                                                    @if ($buisness->getMeridian($hour->closing_time) == $tp)
                                                                                        <option selected
                                                                                            value="{{ $tp }}">
                                                                                            {{ $tp }}
                                                                                        </option>
                                                                                        @php $flag = true; @endphp
                                                                                        <!-- prettier-ignore -->
                                                                                        @break
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                            @if (!$flag)
                                                                                <option value="{{ $tp }}">
                                                                                    {{ $tp }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#locationModal">
                                Ubicación
                            </button>

                            <!-- Location Modal -->
                            <div class="modal fade" id="locationModal" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="locationModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="locationModalLabel">Modificar Ubicación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="map-container mb-5">
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="lat" name="lat" value="{{ $buisness->location->lat }}">
                            <input type="hidden" id="lng" name="lng" value="{{ $buisness->location->lng }}">

                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="{{ __('messages.update') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/components/hours.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $maps }}&callback=initMap&libraries=marker" async
        defer></script>
    <script src="/js/Google/maps.js"></script>

@endsection
