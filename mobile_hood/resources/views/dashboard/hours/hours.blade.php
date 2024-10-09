@extends('dashboard.layout.dashboard')
@section('content')
    @if (session('success'))
        <div class="container">
            <div class="pt-5">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @php
        $openDays = $business->hours->pluck('day_of_week')->toArray();
    @endphp

    <div class="d-flex align-items-center justify-content-center mt-5">
        <div class="card rounded-1 shadow mb-5 p-5 hours-card">
            <div class="d-flex align-items-center mb-5">
                <i class="bx bx-alarm bx-lg me-3 d-none d-sm-block"></i>
                <h3 class="m-0 fw-semibold">Configurá tus horarios</h3>
            </div>
            <form action="{{ route('save-hours') }}" method="POST">
                @csrf
                @foreach ($day as $key => $d)
                    @php
                        $isOpen = in_array(array_search($d, $dayIndex), $openDays);
                    @endphp
                    <div
                        class="row justify-content-start align-items-center mb-4 pb-4 border-bottom border-secondary ps-3 time-row">
                        <p class="m-0 p-0 col-8 col-sm-10 col-lg-2 fw-semibold">{{ $d }}</p>
                        <div class="form-check form-switch col-4 col-sm-2 col-lg-2">
                            <input name="{{ $key }}_switch" class="form-check-input" type="checkbox" role="switch"
                                id="{{ $key }}_switch" {{ $isOpen ? 'checked' : '' }}
                                data-day="{{ $key }}">
                            <label class="form-check-label" for="{{ $key }}_switch" id="{{ $key }}_label">
                                {{ $isOpen ? 'Abierto' : 'Cerrado' }}
                            </label>
                        </div>
                        <div class="row-container time col-12 col-lg-8">
                            <div class="row align-items-center">
                                <div class="d-flex col-12 col-lg-5 align-items-center">
                                    <div class="col-6">
                                        <select name="{{ $key }}_open_time[]" id="{{ $key }}_open_time"
                                            class="form-select">
                                            @foreach ($time as $t)
                                                @php $flag = false; @endphp
                                                @foreach ($business->hours as $hour)
                                                    @if ($dayIndex[$hour->day_of_week] == $d)
                                                        @if ($business->convertTo12HourFormatWithoutMeridian($hour->opening_time) == $t)
                                                            <option selected value="{{ $t }}">
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
                                            id="{{ $key }}_time_period_open" class="form-select me-2">
                                            @foreach ($timePeriod as $tp)
                                                @php $flag = false; @endphp
                                                @foreach ($business->hours as $hour)
                                                    @if ($dayIndex[$hour->day_of_week] == $d)
                                                        @if ($business->getMeridian($hour->opening_time) == $tp)
                                                            <option selected value="{{ $tp }}">
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
                                <p class="fw-semibold p-0 col-2 col-lg-2 text-center until">hasta</p>
                                <div class="d-flex col-12 col-lg-5 align-items-center">
                                    <div class="col-6">
                                        <select name="{{ $key }}_close_time[]"
                                            id="{{ $key }}_close_time" class="form-select">
                                            @foreach ($time as $t)
                                                @php $flag = false; @endphp
                                                @foreach ($business->hours as $hour)
                                                    @if ($dayIndex[$hour->day_of_week] == $d)
                                                        @if ($business->convertTo12HourFormatWithoutMeridian($hour->closing_time) == $t)
                                                            <option selected value="{{ $t }}">
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
                                            id="{{ $key }}_time_period_close" class="form-select">
                                            @foreach ($timePeriod as $tp)
                                                @php $flag = false; @endphp
                                                @foreach ($business->hours as $hour)
                                                    @if ($dayIndex[$hour->day_of_week] == $d)
                                                        @if ($business->getMeridian($hour->closing_time) == $tp)
                                                            <option selected value="{{ $tp }}">
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
                <button type="submit" class="border-0 rounded-1 btn-save text-light mt-3 py-3 fw-semibold w-100">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
