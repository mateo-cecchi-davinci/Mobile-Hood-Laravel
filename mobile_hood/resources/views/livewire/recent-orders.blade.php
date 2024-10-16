<div>
    <div class="recent-orders-content">
        <div
            class="d-flex flex-column align-items-start d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between mb-3">
            <h1 class="fw-bold recent-orders-title">Órdenes recientes</h1>
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn d-flex align-items-center today-dropdown bg-transparent border-0" type="button"
                        data-bs-toggle="dropdown">
                        <p class="m-0 fw-semibold">{{ $timeFilter }}</p>
                        <i class="bx bx-chevron-down bx-sm opacity-75"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" class="dropdown-item fw-semibold"
                                wire:click.prevent="setTimeFilter('Hoy')">Hoy</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item fw-semibold"
                                wire:click.prevent="setTimeFilter('Ayer')">Ayer</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item fw-semibold"
                                wire:click.prevent="setTimeFilter('Últimos 7 días')">Últimos 7 días</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item fw-semibold"
                                wire:click.prevent="setTimeFilter('Todos')">Todos</a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="d-flex align-items-center fw-semibold btn bg-transparent border-0" type="button"
                        data-bs-toggle="dropdown">
                        <p class="m-0">{{ $statusFilter }} - {{ $counter }} ($ {{ $amount }})</p>
                        <i class="bx bx-chevron-down bx-sm opacity-75"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="" class="dropdown-item fw-semibold"
                                wire:click.prevent="setStatusFilter('Entregado')">Entregado</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item fw-semibold"
                                wire:click.prevent="setStatusFilter('Rechazado')">Rechazado</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item fw-semibold"
                                wire:click.prevent="setStatusFilter('Todos')">Todos</a>
                        </li>
                    </ul>
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
            @foreach ($recentOrders as $index => $order)
                <tr>
                    <td class="fw-bold">
                        {{ $order->convertTo12HourFormatWithoutMeridian($order->created_at) }}
                    </td>
                    <td>#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td class="text-end">$ {{ $order->payment }}</td>
                    <td class="text-end">
                        <p
                            class="m-0 p-1 px-2 bg-{{ $order->state == 'Entregado' ? 'success' : 'danger' }}-subtle text-{{ $order->state == 'Entregado' ? 'success' : 'danger' }} sm-font text-center d-inline rounded-1">
                            {{ $order->state }}
                        </p>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @foreach ($recentOrders as $index => $order)
        <div class="justify-content-between align-items-center p-3 border-bottom orders-table-sm">
            <div class="d-flex flex-column justify-content-between row-gap-2">
                <h5 class="m-0">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</h5>
                <div class="d-flex">
                    <i class="bx bxs-user bx-sm me-2"></i>
                    <p class="m-0">{{ $order->user->name }}</p>
                </div>
            </div>
            <div class="d-flex flex-column justify-content-between row-gap-2 text-end">
                <p class="m-0">
                    {{ $order->convertTo12HourFormatWithoutMeridian($order->created_at) }}
                </p>
                <p class="m-0 fw-semibold text-{{ $order->state == 'Entregado' ? 'success' : 'danger' }}">
                    {{ $order->state }}
                </p>
            </div>
        </div>
    @endforeach
</div>
