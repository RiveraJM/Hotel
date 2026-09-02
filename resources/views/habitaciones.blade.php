```blade
{{-- =========================================================
     HABITACIONES
     resources/views/habitaciones.blade.php
========================================================= --}}

@vite(['resources/css/habitaciones.css'])

<x-app-layout>

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

                    </div>

                </div>

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


                                    <button
                                        type="button"

                                        class="room-card {{ $estado }}"

                                        data-id="{{ $habitacion->id }}"

                                        data-room="{{ $habitacion->numero }}"

                                        data-floor="{{ $habitacion->piso }}"

                                        data-status="{{ $habitacion->estado }}"

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


                                    </button>

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



            {{-- =================================================
                 INFORMACIÓN GENERAL
            ================================================== --}}

            <section class="hotel-card rooms-information-panel">

                <div class="rooms-information-item">

                    <span class="information-label">
                        Total
                    </span>

                    <strong>
                        {{ $totalHabitaciones }}
                    </strong>

                </div>


                <div class="rooms-information-item">

                    <span class="information-label">
                        Libres
                    </span>

                    <strong class="information-available">
                        {{ $libres }}
                    </strong>

                </div>


                <div class="rooms-information-item">

                    <span class="information-label">
                        Reservadas
                    </span>

                    <strong class="information-reserved">
                        {{ $reservadas }}
                    </strong>

                </div>


                <div class="rooms-information-item">

                    <span class="information-label">
                        Ocupadas
                    </span>

                    <strong class="information-occupied">
                        {{ $ocupadas }}
                    </strong>

                </div>


                <div class="rooms-information-item">

                    <span class="information-label">
                        Mantenimiento
                    </span>

                    <strong class="information-maintenance">
                        {{ $mantenimiento }}
                    </strong>

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


                    const matchesSearch =
                        roomNumber.includes(searchValue);


                    const matchesFilter =
                        currentFilter === 'all'
                        ||
                        roomStatus === currentFilter;


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
