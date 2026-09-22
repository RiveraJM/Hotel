<x-app-layout>

    @push('styles')
        @vite(['resources/css/reservas.css'])
    @endpush
    @php
        $habitacionesPorPiso = $habitaciones->groupBy('piso');
        $porcentajeConfirmadas = $totalReservas > 0 ? round(($confirmadas / $totalReservas) * 100, 1) : 0;
    @endphp


    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
    <div class="reservations-page">
        <main class="reservations-main">
            <header class="hotel-header">
                <div class="header-left"></div>
                <div class="header-right">
                    <button class="header-icon-button" type="button">
                        <i class="fa-regular fa-bell"></i>
                        <span class="notification-dot"></span>
                    </button>
                    <div class="header-user">
                        <div class="header-user-avatar">A</div>
                        <div class="header-user-info"><strong>Administrador</strong></div>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <section class="reservations-content">
                @if (session('success'))
                    <div class="reservation-success-message">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="reservations-top">
                    <div><span class="reservations-section-label">GESTIÓN DE RESERVAS</span></div>
                    <a class="reservation-primary-button" href="{{ route('reservas.create') }}">
                        <i class="fa-solid fa-plus"></i> Nueva reserva
                    </a>
                </div>

                <div class="reservation-statistics">
                    <div class="reservation-stat-card">
                        <div class="reservation-stat-icon total"><i class="fa-solid fa-calendar-days"></i></div>
                        <div class="reservation-stat-information">
                            <span>Total reservas</span><strong>{{ $totalReservas }}</strong><small>Registradas</small>
                        </div>
                    </div>
                    <div class="reservation-stat-card">
                        <div class="reservation-stat-icon confirmed"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="reservation-stat-information">
                            <span>Confirmadas</span><strong>{{ $confirmadas }}</strong><small>{{ $porcentajeConfirmadas }}% del total</small>
                        </div>
                    </div>
                    <div class="reservation-stat-card">
                        <div class="reservation-stat-icon pending"><i class="fa-solid fa-clock"></i></div>
                        <div class="reservation-stat-information">
                            <span>Pendientes</span><strong>{{ $pendientes }}</strong><small>Requieren atención</small>
                        </div>
                    </div>
                    <div class="reservation-stat-card">
                        <div class="reservation-stat-icon cancelled"><i class="fa-solid fa-circle-xmark"></i></div>
                        <div class="reservation-stat-information">
                            <span>Canceladas</span><strong>{{ $canceladas }}</strong><small>Registradas</small>
                        </div>
                    </div>
                </div>

                <div class="reservations-filter-panel">
                    <form class="reservation-floor-filter" method="GET" action="{{ route('reservas.index') }}">
                        <label for="piso">Piso</label>
                        <select id="piso" name="piso" onchange="this.form.submit()">
                            <option value="">Todos los pisos</option>
                            @foreach ($pisos as $piso)
                                <option value="{{ $piso }}" @selected((int) $pisoSeleccionado === (int) $piso)>Piso {{ $piso }}</option>
                            @endforeach
                        </select>
                    </form>
                    <div class="reservation-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Buscar huésped, reserva o habitación...">
                    </div>
                    <div class="reservation-filter"><i class="fa-solid fa-filter"></i><select><option>Todos los estados</option><option>Confirmada</option><option>Pendiente</option><option>Cancelada</option></select></div>
                    <div class="reservation-filter"><i class="fa-regular fa-calendar"></i><select><option>Todas las fechas</option><option>Hoy</option><option>Próximos 7 días</option><option>Este mes</option></select></div>
                    <div class="reservation-filter"><i class="fa-solid fa-bed"></i><select><option>Todos los tipos</option>@foreach ($habitaciones->pluck('tipo')->unique() as $tipo)<option>{{ $tipo }}</option>@endforeach</select></div>
                </div>

                <div class="rooms-map-panel">
                    <div class="rooms-map-header">
                        <div><h3>Disponibilidad de habitaciones</h3></div>
                        <div class="rooms-legend">
                            <div class="legend-item"><span class="legend-dot reserved"></span><span>Reservadas</span></div>
                        </div>
                    </div>

                    @forelse ($habitacionesReservadas->groupBy('piso') as $piso => $habitacionesDelPiso)
                        <div class="hotel-floor">
                            <div class="floor-header">
                                <div class="floor-title">
                                    <span class="floor-number">{{ $piso }}</span>
                                    <div><strong>Piso {{ $piso }}</strong><span>{{ $habitacionesDelPiso->count() }} habitaciones</span></div>
                                </div>
                            </div>
                            <div class="rooms-grid">
                                @foreach ($habitacionesDelPiso as $habitacion)
                                    @php
                                        $estado = $habitacion->estado;
                                        $estadoLabel = ['libre' => 'LIBRE', 'reservada' => 'RESERVADA', 'ocupada' => 'OCUPADA', 'mantenimiento' => 'MANTENIMIENTO'][$estado] ?? strtoupper($estado);
                                    @endphp
                                    <div class="reserved-room-card">
                                        <div class="room-card {{ $estado }}" data-id="{{ $habitacion->id }}" data-room="{{ $habitacion->numero }}" data-status="{{ $estado }}">
                                            <span class="room-number">{{ $habitacion->numero }}</span>
                                            <span class="room-status">{{ $estadoLabel }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="hotel-floor">No hay habitaciones registradas.</div>
                    @endforelse
                </div>

                <div class="reservations-list-panel">
                    <div class="reservations-list-header">
                        <div><h3>Reservas registradas</h3></div>
                        <button class="reservation-view-all" type="button">Ver todas <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                    <div class="reservations-table-wrapper">
                        <table class="reservations-table">
                            <thead><tr><th>RESERVA</th><th>HUÉSPED</th><th>HABITACIÓN</th><th>ENTRADA</th><th>SALIDA</th><th>HUÉSPEDES</th><th>ESTADO</th><th>MODIFICAR</th></tr></thead>
                            <tbody>
                                @forelse ($reservas as $reserva)
                                    @php
                                        $nombre = $reserva->huesped?->nombre ?? 'Sin huésped asignado';
                                        $iniciales = $reserva->huesped
                                            ? collect(explode(' ', trim($nombre)))->filter()->take(2)->map(fn ($parte) => mb_strtoupper(mb_substr($parte, 0, 1)))->implode('')
                                            : '?';
                                        $estadoLabel = ucfirst($reserva->estado);
                                    @endphp
                                    <tr>
                                        <td><strong class="reservation-code">#{{ $reserva->codigo }}</strong></td>
                                        <td><div class="reservation-guest"><div class="reservation-avatar">{{ $iniciales }}</div><div><strong>{{ $nombre }}</strong><span>{{ $reserva->huesped ? $reserva->huesped->tipo_documento . ' ' . $reserva->huesped->numero_documento : 'Reserva detectada por estado de habitación' }}</span></div></div></td>
                                        <td><span class="reservation-room">{{ $reserva->habitacion->numero }}</span></td>
                                        <td>{{ $reserva->fecha_entrada?->format('d M. Y') ?? 'Pendiente' }}</td>
                                        <td>{{ $reserva->fecha_salida?->format('d M. Y') ?? 'Pendiente' }}</td>
                                        <td>{{ $reserva->cantidad_huespedes }}</td>
                                        <td><span class="reservation-status {{ $reserva->estado }}"><span></span>{{ $estadoLabel }}</span></td>
                                        <td>
                                            <div class="reservation-row-actions">
                                                @if (!$reserva->huesped)
                                                    <a class="reservation-action reservation-assign-action" href="{{ route('reservas.assign', $reserva->habitacion) }}" title="Asignar huésped">
                                                        <i class="fa-solid fa-user-plus"></i>
                                                    </a>
                                                @elseif ($reserva->exists)
                                                    <a class="reservation-action reservation-edit-action" href="{{ route('reservas.edit', $reserva) }}" title="Editar reserva">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8">No hay reservas registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="reservations-list-footer">
                        <span>Mostrando <strong>{{ $totalReservas }}</strong> de <strong>{{ $totalReservas }}</strong> reservas</span>
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>