@extends('dashboard.layout.dashboard')
@section('content')
    <div class="recent-orders-content">
        <div
            class="d-flex flex-column align-items-start d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between mb-3">
            <h1 class="fw-bold recent-orders-title">Órdenes recientes</h1>
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn d-flex align-items-center today-dropdown bg-transparent border-0" type="button"
                        data-bs-toggle="dropdown">
                        <p class="m-0 fw-semibold">Hoy</p>
                        <i class="bx bx-chevron-down bx-sm opacity-75"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="" class="dropdown-item fw-semibold">Ayer</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item fw-semibold">Últimos 7 días</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item fw-semibold">Todos</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center fw-semibold">
                    <p class="m-0">Todos - 4 ($ 43,000.00)</p>
                </div>
            </div>
        </div>
        <table class="orders-table mt-3 w-100 fw-semibold">
            <tr>
                <th>Horario</th>
                <th>Orden</th>
                <th>Cliente</th>
                <th class="text-end">Total</th>
                <th class="text-end">Estado</th>
            </tr>
            <tr>
                <td class="fw-bold">9:41</td>
                <td>#01</td>
                <td>Marco Aurelio</td>
                <td class="text-end">$ 14.000</td>
                <td class="text-end">
                    <p class="m-0 p-1 px-2 bg-success-subtle text-success sm-font text-center d-inline rounded-1">
                        Aceptado
                    </p>
                </td>
            </tr>
        </table>
    </div>
    <div class="justify-content-between align-items-center p-3 border-bottom orders-table-sm">
        <div class="d-flex flex-column justify-content-between row-gap-2">
            <h5 class="m-0">#01</h5>
            <div class="d-flex">
                <i class="bx bxs-user bx-sm me-2"></i>
                <p class="m-0">Marco Aurelio</p>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between row-gap-2 text-end">
            <p class="m-0">11:33</p>
            <p class="m-0 fw-semibold text-success">Aceptado</p>
        </div>
    </div>
@endsection
