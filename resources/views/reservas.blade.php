@vite(['resources/css/reservas.css'])

<x-app-layout>
    @php
        $habitacionesPorPiso = $habitaciones->groupBy('piso');
        $porcentajeConfirmadas = $totalReservas > 0 ? round(($confirmadas / $totalReservas) * 100, 1) : 0;
    @endphp

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
                <div class="reservations-top">
                    <div><span class="reservations-section-label">GESTIÓN DE RESERVAS</span></div>
                    <button class="reservation-primary-button" type="button">
                        <i class="fa-solid fa-plus"></i> Nueva reserva
                    </button>
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
                            <div class="legend-item"><span class="legend-dot available"></span><span>Libre</span></div>
                            <div class="legend-item"><span class="legend-dot reserved"></span><span>Reservada</span></div>
                            <div class="legend-item"><span class="legend-dot occupied"></span><span>Ocupada</span></div>
                        </div>
                    </div>

                    @forelse ($habitacionesPorPiso as $piso => $habitacionesDelPiso)
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
                                    <button type="button" class="room-card {{ $estado }}" data-id="{{ $habitacion->id }}" data-room="{{ $habitacion->numero }}" data-status="{{ $estado }}">
                                        <span class="room-number">{{ $habitacion->numero }}</span>
                                        <span class="room-status">{{ $estadoLabel }}</span>
                                    </button>
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
                            <thead><tr><th>RESERVA</th><th>HUÉSPED</th><th>HABITACIÓN</th><th>ENTRADA</th><th>SALIDA</th><th>HUÉSPEDES</th><th>ESTADO</th><th></th></tr></thead>
                            <tbody>
                                @forelse ($reservas as $reserva)
                                    @php
                                        $nombre = $reserva->huesped->nombre;
                                        $iniciales = collect(explode(' ', trim($nombre)))->filter()->take(2)->map(fn ($parte) => mb_strtoupper(mb_substr($parte, 0, 1)))->implode('');
                                        $estadoLabel = ucfirst($reserva->estado);
                                    @endphp
                                    <tr>
                                        <td><strong class="reservation-code">#{{ $reserva->codigo }}</strong></td>
                                        <td><div class="reservation-guest"><div class="reservation-avatar">{{ $iniciales }}</div><div><strong>{{ $nombre }}</strong><span>{{ $reserva->huesped->tipo_documento }} {{ $reserva->huesped->numero_documento }}</span></div></div></td>
                                        <td><span class="reservation-room">{{ $reserva->habitacion->numero }}</span></td>
                                        <td>{{ $reserva->fecha_entrada->format('d M. Y') }}</td>
                                        <td>{{ $reserva->fecha_salida->format('d M. Y') }}</td>
                                        <td>{{ $reserva->cantidad_huespedes }}</td>
                                        <td><span class="reservation-status {{ $reserva->estado }}"><span></span>{{ $estadoLabel }}</span></td>
                                        <td><button class="reservation-action" type="button" data-id="{{ $reserva->id }}"><i class="fa-solid fa-ellipsis-vertical"></i></button></td>
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