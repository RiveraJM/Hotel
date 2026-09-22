```blade
{{-- =========================================================
     HABITACIONES
     resources/views/habitaciones.blade.php
========================================================= --}}

<x-app-layout>

    @push('styles')
        @vite(['resources/css/habitaciones.css'])
    @endpush

    @php
        /*
        |--------------------------------------------------------------------------
        | AGRUPACIÓN DE HABITACIONES
        |--------------------------------------------------------------------------
        */

        $habitacionesPorPiso = $habitaciones->groupBy('piso');

        $totalHabitaciones = $habitaciones->count();

        $libres = $habitaciones
            ->where('estado', 'libre')
            ->count();

        $reservadas = $habitaciones
            ->where('estado', 'reservada')
            ->count();

        $ocupadas = $habitaciones
            ->where('estado', 'ocupada')
            ->count();

        $mantenimiento = $habitaciones
            ->where('estado', 'mantenimiento')
            ->count();
    @endphp


    <div class="hotel-dashboard">

        {{-- =====================================================
             HEADER DEL MÓDULO
        ====================================================== --}}

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


        {{-- =====================================================
             CONTENIDO PRINCIPAL
        ====================================================== --}}

        <main class="hotel-dashboard-content">


            {{-- =================================================
                 RESUMEN
            ================================================== --}}

            <section class="hotel-stats-grid">


                {{-- TOTAL --}}
                <div class="hotel-card hotel-stat-card">

                    <div class="hotel-stat-content">

                        <span class="hotel-stat-label">
                            Total habitaciones
                        </span>

                        <strong class="hotel-stat-number">
                            {{ $totalHabitaciones }}
                        </strong>

                    </div>

                    <div class="hotel-stat-icon hotel-stat-icon-total">
                        🛏️
                    </div>

                </div>


                {{-- LIBRES --}}
                <div class="hotel-card hotel-stat-card">

                    <div class="hotel-stat-content">

                        <span class="hotel-stat-label">
                            Disponibles
                        </span>

                        <strong class="hotel-stat-number">
                            {{ $libres }}
                        </strong>

                    </div>

                    <div class="hotel-stat-icon hotel-stat-icon-available">
                        ✓
                    </div>

                </div>


                {{-- OCUPADAS --}}
                <div class="hotel-card hotel-stat-card">

                    <div class="hotel-stat-content">

                        <span class="hotel-stat-label">
                            Ocupadas
                        </span>

                        <strong class="hotel-stat-number">
                            {{ $ocupadas }}
                        </strong>

                    </div>

                    <div class="hotel-stat-icon hotel-stat-icon-occupied">
                        ●
                    </div>

                </div>


                {{-- RESERVADAS --}}
                <div class="hotel-card hotel-stat-card">

                    <div class="hotel-stat-content">

                        <span class="hotel-stat-label">
                            Reservadas
                        </span>

                        <strong class="hotel-stat-number">
                            {{ $reservadas }}
                        </strong>

                    </div>

                    <div class="hotel-stat-icon hotel-stat-icon-reserved">
                        📅
                    </div>

                </div>

            </section>



            {{-- =================================================
                 BUSCADOR Y FILTROS
            ================================================== --}}

            <section class="hotel-card hotel-search-panel">

                <div class="hotel-search-wrapper">


                    {{-- BUSCADOR --}}

                    <div class="hotel-search-box">

                        <span class="hotel-search-icon">
                            🔎
                        </span>

                        <input
                            type="text"
                            id="roomSearch"
                            class="hotel-search-input"
                            placeholder="Buscar habitación por número..."
                            autocomplete="off"
                        >

                    </div>


                    {{-- FILTROS --}}

                    <div class="hotel-filter-group">

                        <button
                            type="button"
                            class="hotel-filter-button hotel-filter-active"
                            data-filter="all"
                        >
                            Todas
                        </button>

                        <button
                            type="button"
                            class="hotel-filter-button"
                            data-filter="libre"
                        >
                            Disponibles
                        </button>

                        <button
                            type="button"
                            class="hotel-filter-button"
                            data-filter="ocupada"
                        >
                            Ocupadas
                        </button>

                        <button
                            type="button"
                            class="hotel-filter-button"
                            data-filter="reservada"
                        >
                            Reservadas
                        </button>

                        <button
                            type="button"
                            class="hotel-filter-button"
                            data-filter="mantenimiento"
                        >
                            Mantenimiento
                        </button>

                        <button
                            type="button"
                            class="hotel-filter-button"
                            data-filter="pagada"
                        >
                            Pagadas
                        </button>

                    </div>

                </div>

            </section>

            @if (session('success'))
                <div class="hotel-card" style="padding: 1rem 1.25rem; margin-bottom: 1rem; border-left: 4px solid #10b981; background: rgba(16,185,129,0.08); color: #0f172a;">
                    <strong>✅</strong>
                    {{ session('success') }}
                </div>
            @endif

            <section class="hotel-card" id="registrar-habitacion" style="padding: 1.25rem; margin-bottom: 1.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                    <div>
                        <h3 style="margin: 0; font-size: 1.2rem; color: #0f172a;">Registrar habitación</h3>
                        <p style="margin: 0.3rem 0 0; color: #475569;">Agrega una nueva habitación al hotel.</p>
                    </div>
                </div>

                <form action="{{ route('habitaciones.store') }}" method="POST" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
                    @csrf

                    <div>
                        <label for="numero" style="display: block; margin-bottom: 0.35rem; font-weight: 600; color: #334155;">Número</label>
                        <input id="numero" name="numero" type="text" value="{{ old('numero') }}" required style="width: 100%; padding: 0.75rem 0.9rem; border: 1px solid #dbe3ee; border-radius: 10px; background: #fff; color: #0f172a;">
                        @error('numero')
                            <small style="display:block; color:#dc2626; margin-top:0.35rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="piso" style="display: block; margin-bottom: 0.35rem; font-weight: 600; color: #334155;">Piso</label>
                        <input id="piso" name="piso" type="number" min="1" max="20" value="{{ old('piso', 1) }}" required style="width: 100%; padding: 0.75rem 0.9rem; border: 1px solid #dbe3ee; border-radius: 10px; background: #fff; color: #0f172a;">
                        @error('piso')
                            <small style="display:block; color:#dc2626; margin-top:0.35rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="tipo" style="display: block; margin-bottom: 0.35rem; font-weight: 600; color: #334155;">Tipo</label>
                        <select id="tipo" name="tipo" required style="width: 100%; padding: 0.75rem 0.9rem; border: 1px solid #dbe3ee; border-radius: 10px; background: #fff; color: #0f172a;">
                            <option value="">Selecciona</option>
                            <option value="Individual" {{ old('tipo') === 'Individual' ? 'selected' : '' }}>Individual</option>
                            <option value="Doble" {{ old('tipo') === 'Doble' ? 'selected' : '' }}>Doble</option>
                            <option value="Suite" {{ old('tipo') === 'Suite' ? 'selected' : '' }}>Suite</option>
                            <option value="Familiar" {{ old('tipo') === 'Familiar' ? 'selected' : '' }}>Familiar</option>
                        </select>
                        @error('tipo')
                            <small style="display:block; color:#dc2626; margin-top:0.35rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="capacidad" style="display: block; margin-bottom: 0.35rem; font-weight: 600; color: #334155;">Capacidad</label>
                        <input id="capacidad" name="capacidad" type="number" min="1" max="20" value="{{ old('capacidad', 2) }}" required style="width: 100%; padding: 0.75rem 0.9rem; border: 1px solid #dbe3ee; border-radius: 10px; background: #fff; color: #0f172a;">
                        @error('capacidad')
                            <small style="display:block; color:#dc2626; margin-top:0.35rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="precio" style="display: block; margin-bottom: 0.35rem; font-weight: 600; color: #334155;">Precio</label>
                        <input id="precio" name="precio" type="number" min="0" step="0.01" value="{{ old('precio') }}" required style="width: 100%; padding: 0.75rem 0.9rem; border: 1px solid #dbe3ee; border-radius: 10px; background: #fff; color: #0f172a;">
                        @error('precio')
                            <small style="display:block; color:#dc2626; margin-top:0.35rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="estado" style="display: block; margin-bottom: 0.35rem; font-weight: 600; color: #334155;">Estado</label>
                        <select id="estado" name="estado" required style="width: 100%; padding: 0.75rem 0.9rem; border: 1px solid #dbe3ee; border-radius: 10px; background: #fff; color: #0f172a;">
                            <option value="libre" {{ old('estado', 'libre') === 'libre' ? 'selected' : '' }}>Libre</option>
                            <option value="reservada" {{ old('estado') === 'reservada' ? 'selected' : '' }}>Reservada</option>
                            <option value="ocupada" {{ old('estado') === 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                            <option value="mantenimiento" {{ old('estado') === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                        </select>
                        @error('estado')
                            <small style="display:block; color:#dc2626; margin-top:0.35rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <label for="descripcion" style="display: block; margin-bottom: 0.35rem; font-weight: 600; color: #334155;">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3" style="width: 100%; padding: 0.75rem 0.9rem; border: 1px solid #dbe3ee; border-radius: 10px; background: #fff; color: #0f172a; resize: vertical;">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <small style="display:block; color:#dc2626; margin-top:0.35rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div style="grid-column: 1 / -1; display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 0.5rem;">
                        <button type="reset" class="hotel-secondary-button" style="padding: 0.8rem 1.1rem; background: #e2e8f0; color: #0f172a; border: none; border-radius: 10px; font-weight: 600; cursor: pointer;">
                            Limpiar
                        </button>
                        <button type="submit" class="hotel-primary-button" style="padding: 0.8rem 1.2rem; background: linear-gradient(135deg, #0f172a, #1d4ed8); color: white; border: none; border-radius: 10px; font-weight: 700; cursor: pointer;">
                            + Guardar habitación
                        </button>
                    </div>
                </form>
            </section>



            {{-- =================================================
                 MAPA DE HABITACIONES
            ================================================== --}}

            <section class="rooms-map-panel">


                {{-- CABECERA DEL MAPA --}}

                <div class="rooms-map-header">

                    <div class="rooms-map-title">

                        <h2>
                            Mapa de habitaciones
                        </h2>

                        <p>
                            Consulta el estado actual de cada habitación por piso.
                        </p>

                    </div>


                    {{-- LEYENDA --}}

                    <div class="rooms-legend">

                        <div class="legend-item">

                            <span class="legend-dot available"></span>

                            <span>
                                Libre
                            </span>

                        </div>


                        <div class="legend-item">

                            <span class="legend-dot reserved"></span>

                            <span>
                                Reservada
                            </span>

                        </div>


                        <div class="legend-item">

                            <span class="legend-dot occupied"></span>

                            <span>
                                Ocupada
                            </span>

                        </div>


                        <div class="legend-item">

                            <span class="legend-dot maintenance"></span>

                            <span>
                                Mantenimiento
                            </span>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     PISOS
                ================================================== --}}

                <div class="rooms-floors-container">


                    @forelse ($habitacionesPorPiso as $piso => $habitacionesDelPiso)

                        @php

                            $libresPiso = $habitacionesDelPiso
                                ->where('estado', 'libre')
                                ->count();

                            $reservadasPiso = $habitacionesDelPiso
                                ->where('estado', 'reservada')
                                ->count();

                            $ocupadasPiso = $habitacionesDelPiso
                                ->where('estado', 'ocupada')
                                ->count();

                            $mantenimientoPiso = $habitacionesDelPiso
                                ->where('estado', 'mantenimiento')
                                ->count();

                        @endphp


                        <section
                            class="hotel-floor"
                            data-floor="{{ $piso }}"
                        >


                            {{-- CABECERA DEL PISO --}}

                            <div class="floor-header">


                                <div class="floor-title">

                                    <span class="floor-number">
                                        {{ $piso }}
                                    </span>

                                    <div class="floor-information">

                                        <strong>
                                            Piso {{ $piso }}
                                        </strong>

                                        <span>
                                            {{ $habitacionesDelPiso->count() }}
                                            habitaciones
                                        </span>

                                    </div>

                                </div>


                                {{-- RESUMEN DEL PISO --}}

                                <div class="floor-summary">


                                    @if ($libresPiso > 0)

                                        <span class="summary-available">
                                            {{ $libresPiso }}
                                            {{ $libresPiso === 1 ? 'libre' : 'libres' }}
                                        </span>

                                    @endif


                                    @if ($reservadasPiso > 0)

                                        <span class="summary-reserved">
                                            {{ $reservadasPiso }}
                                            {{ $reservadasPiso === 1 ? 'reservada' : 'reservadas' }}
                                        </span>

                                    @endif


                                    @if ($ocupadasPiso > 0)

                                        <span class="summary-occupied">
                                            {{ $ocupadasPiso }}
                                            {{ $ocupadasPiso === 1 ? 'ocupada' : 'ocupadas' }}
                                        </span>

                                    @endif


                                    @if ($mantenimientoPiso > 0)

                                        <span class="summary-maintenance">
                                            {{ $mantenimientoPiso }}
                                            {{ $mantenimientoPiso === 1 ? 'mantenimiento' : 'en mantenimiento' }}
                                        </span>

                                    @endif

                                </div>

                            </div>



                            {{-- =================================================
                                 HABITACIONES DEL PISO
                            ================================================== --}}

                            <div class="rooms-grid">


                                @foreach ($habitacionesDelPiso as $habitacion)

                                    @php

                                        $estado = $habitacion->estado;
                                        $reservaActual = $habitacion->reservas->first();
                                        $pagoLabel = $reservaActual?->payment_status === 'pagado' ? 'Pagada' : ($reservaActual ? 'Pago pendiente' : 'Sin reserva');
                                        $pagoFilter = $reservaActual?->payment_status === 'pagado' ? 'pagada' : 'sin-pago';

                                        $estadoLabel = match ($estado) {

                                            'libre' =>
                                                'Libre',

                                            'reservada' =>
                                                'Reservada',

                                            'ocupada' =>
                                                'Ocupada',

                                            'mantenimiento' =>
                                                'Mantenimiento',

                                            default =>
                                                ucfirst($estado),

                                        };

                                    @endphp


                                    <a
                                        href="{{ route('habitaciones.show', $habitacion) }}"
                                        class="room-card {{ $estado }}"
                                        data-id="{{ $habitacion->id }}"
                                        data-room="{{ $habitacion->numero }}"
                                        data-floor="{{ $habitacion->piso }}"
                                        data-status="{{ $habitacion->estado }}"
                                        data-payment="{{ $pagoFilter }}"
                                        aria-label="
                                            Habitación
                                            {{ $habitacion->numero }},
                                            {{ $estadoLabel }}
                                        "
                                    >


                                        {{-- NÚMERO --}}

                                        <span class="room-number">
                                            {{ $habitacion->numero }}
                                        </span>


                                        {{-- ESTADO --}}

                                        <span class="room-card-status">

                                            <span class="room-status-indicator"></span>

                                            {{ $estadoLabel }}

                                        </span>

                                        <span class="room-card-payment {{ $pagoFilter }}">
                                            <i class="fa-solid fa-receipt"></i>
                                            {{ $pagoLabel }}
                                        </span>


                                    </a>

                                @endforeach


                            </div>

                        </section>

                    @empty


                        {{-- SIN HABITACIONES --}}

                        <div class="empty-rooms-state">

                            <div class="empty-rooms-icon">
                                🛏️
                            </div>

                            <h3>
                                No hay habitaciones registradas
                            </h3>

                            <p>
                                Cuando registres habitaciones,
                                aparecerán automáticamente en este mapa.
                            </p>

                            <a
                                href="#"
                                class="hotel-primary-button"
                            >
                                + Registrar habitación
                            </a>

                        </div>


                    @endforelse


                </div>

            </section>



           


        </main>

    </div>


    {{-- =========================================================
         JAVASCRIPT PREPARADO PARA FUNCIONALIDADES
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const searchInput =
                document.getElementById('roomSearch');

            const filterButtons =
                document.querySelectorAll('.hotel-filter-button');

            const roomCards =
                document.querySelectorAll('.room-card');


            let currentFilter = 'all';


            /*
            |--------------------------------------------------------------------------
            | FILTRAR HABITACIONES
            |--------------------------------------------------------------------------
            */

            function filterRooms() {

                const searchValue =
                    searchInput
                        ? searchInput.value
                            .toLowerCase()
                            .trim()
                        : '';


                roomCards.forEach(function (room) {

                    const roomNumber =
                        room.dataset.room
                            .toLowerCase();

                    const roomStatus =
                        room.dataset.status;

                    const roomPayment =
                        room.dataset.payment;


                    const matchesSearch =
                        roomNumber.includes(searchValue);


                    const matchesFilter =
                        currentFilter === 'all'
                        ||
                        roomStatus === currentFilter
                        || roomPayment === currentFilter;


                    if (
                        matchesSearch &&
                        matchesFilter
                    ) {

                        room.style.display = '';

                    } else {

                        room.style.display = 'none';

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | BUSCADOR
            |--------------------------------------------------------------------------
            */

            if (searchInput) {

                searchInput.addEventListener(
                    'input',
                    filterRooms
                );

            }


            /*
            |--------------------------------------------------------------------------
            | FILTROS
            |--------------------------------------------------------------------------
            */

            filterButtons.forEach(function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        filterButtons.forEach(function (item) {

                            item.classList.remove(
                                'hotel-filter-active'
                            );

                        });


                        button.classList.add(
                            'hotel-filter-active'
                        );


                        currentFilter =
                            button.dataset.filter;


                        filterRooms();

                    }
                );

            });


            /*
            |--------------------------------------------------------------------------
            | CLICK EN HABITACIÓN
            |--------------------------------------------------------------------------
            |
            | Por ahora solamente dejamos preparada
            | la información necesaria para conectar
            | las funcionalidades posteriormente.
            |
            */

            roomCards.forEach(function (room) {

                room.addEventListener(
                    'click',
                    function () {

                        const habitacionId =
                            room.dataset.id;

                        const numero =
                            room.dataset.room;

                        const estado =
                            room.dataset.status;


                        /*
                        |--------------------------------------------------------------------------
                        | FUTURA LÓGICA
                        |--------------------------------------------------------------------------
                        |
                        | libre:
                        |     crear reserva
                        |
                        | reservada:
                        |     consultar reserva
                        |
                        | ocupada:
                        |     consultar huésped
                        |
                        | mantenimiento:
                        |     consultar mantenimiento
                        |
                        */

                        console.log(
                            'Habitación:',
                            habitacionId,
                            numero,
                            estado
                        );

                    }
                );

            });

        });

    </script>

</x-app-layout>
```
