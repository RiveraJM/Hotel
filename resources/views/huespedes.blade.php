```blade
{{-- =========================================================
     HUÉSPEDES
     resources/views/huespedes.blade.php
========================================================= --}}

@vite(['resources/css/huespedes.css'])

<x-app-layout>

<div class="guests-page">

    {{-- =========================================================
         CONTENIDO PRINCIPAL
    ========================================================== --}}

    <main class="guests-main">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="hotel-header guests-header">

            <div class="header-left">
                {{-- Espacio reservado para futuras opciones --}}
            </div>

            <div class="header-right">

                <button
                    type="button"
                    class="header-icon-button"
                    title="Notificaciones"
                >
                    <i class="fa-regular fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>

                <div class="header-user">

                    <div class="header-user-avatar">A</div>

                    <div class="header-user-info">
                        <strong>Administrador</strong>
                    </div>

                    <i class="fa-solid fa-chevron-down"></i>

                </div>

            </div>

        </header>


        {{-- =====================================================
             CONTENIDO DE HUÉSPEDES
        ====================================================== --}}

        <section class="guests-content">


            {{-- =================================================
                 ENCABEZADO DEL MÓDULO
            ================================================== --}}

            <div class="guests-top">

                <div>

                    

                    <h2>
                        Directorio de huéspedes
                    </h2>

                    <p>
                        Consulta, registra y administra la información
                        de las personas que se hospedan en el hotel.
                    </p>

                </div>


                {{-- NUEVO HUÉSPED --}}

                <a
                    href="{{ route('huespedes.create') }}"
                    class="guest-primary-button"
                >
                    <i class="fa-solid fa-plus"></i>
                    NUEVO HUÉSPED
                </a>

            </div>



            {{-- =================================================
                 ESTADÍSTICAS
            ================================================== --}}

            <div class="guest-statistics">


                {{-- TOTAL --}}

                <div class="guest-stat-card">

                    <div class="guest-stat-icon total">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <div class="guest-stat-information">

                        <span class="guest-stat-label">
                            Total huéspedes
                        </span>

                        <strong>
                            {{ $totalHuespedes }}
                        </strong>

                        <small>
                            Total registrados
                        </small>

                    </div>

                </div>


                {{-- ACTIVOS --}}

                <div class="guest-stat-card">

                    <div class="guest-stat-icon active">
                        <i class="fa-solid fa-user-check"></i>
                    </div>

                    <div class="guest-stat-information">

                        <span class="guest-stat-label">
                            Huéspedes activos
                        </span>

                        <strong>
                            {{ $huespedesActivos }}
                        </strong>

                        <small>
                            Registrados actualmente
                        </small>

                    </div>

                </div>


                {{-- ALOJADOS --}}

                <div class="guest-stat-card">

                    <div class="guest-stat-icon staying">
                        <i class="fa-solid fa-bed"></i>
                    </div>

                    <div class="guest-stat-information">

                        <span class="guest-stat-label">
                            Huéspedes alojados
                        </span>

                        <strong>
                            {{ $huespedesAlojados }}
                        </strong>

                        <small>
                            Actualmente en el hotel
                        </small>

                    </div>

                </div>


                {{-- PRÓXIMAS LLEGADAS --}}

                <div class="guest-stat-card">

                    <div class="guest-stat-icon arrivals">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>

                    <div class="guest-stat-information">

                        <span class="guest-stat-label">
                            Próximas llegadas
                        </span>

                        <strong>
                            {{ $proximasLlegadas }}
                        </strong>

                        <small>
                            Reservas próximas
                        </small>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 BÚSQUEDA Y FILTROS
            ================================================== --}}

            <div class="guests-toolbar">

                <form
                    action="{{ route('huespedes.index') }}"
                    method="GET"
                    class="guests-search-form"
                >

                    <div class="guest-search-box">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Buscar por nombre, DNI, pasaporte o teléfono..."
                            autocomplete="off"
                        >

                    </div>


                    <select
                        name="estado"
                        class="guest-filter-select"
                    >

                        <option value="">
                            Todos los huéspedes
                        </option>

                        <option
                            value="activo"
                            {{ request('estado') === 'activo' ? 'selected' : '' }}
                        >
                            Activos
                        </option>

                        <option
                            value="alojado"
                            {{ request('estado') === 'alojado' ? 'selected' : '' }}
                        >
                            Alojados
                        </option>

                        <option
                            value="reserva"
                            {{ request('estado') === 'reserva' ? 'selected' : '' }}
                        >
                            Con reserva
                        </option>

                        <option
                            value="inactivo"
                            {{ request('estado') === 'inactivo' ? 'selected' : '' }}
                        >
                            Inactivos
                        </option>

                    </select>


                    <button
                        type="submit"
                        class="guest-search-button"
                    >
                        Buscar
                    </button>

                </form>


                @if(request()->filled('buscar') || request()->filled('estado'))

                    <a
                        href="{{ route('huespedes.index') }}"
                        class="guest-clear-filter"
                    >
                        <i class="fa-solid fa-xmark"></i>
                        Limpiar filtros
                    </a>

                @endif

            </div>



            {{-- =================================================
                 TABLA
            ================================================== --}}

            <div class="guests-table-card">


                {{-- CABECERA DE TABLA --}}

                <div class="guests-table-header">

                    <div>

                        <h3>
                            Huéspedes registrados
                        </h3>

                        <p>
                            Información general de los huéspedes registrados.
                        </p>

                    </div>

                </div>



                {{-- TABLA --}}

                <div class="guests-table-wrapper">

                    <table class="guests-table">

                        <thead>

                            <tr>

                                <th>
                                    Huésped
                                </th>

                                <th>
                                    Documento
                                </th>

                                <th>
                                    Teléfono
                                </th>

                                <th>
                                    Habitación
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Registro
                                </th>

                                <th>
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($huespedes as $huesped)

                                @php

                                    /*
                                    |--------------------------------------------------------------------------
                                    | INICIALES
                                    |--------------------------------------------------------------------------
                                    */

                                    $iniciales = collect(
                                        explode(
                                            ' ',
                                            trim($huesped->nombre)
                                        )
                                    )
                                    ->filter()
                                    ->take(2)
                                    ->map(
                                        fn ($parte) =>
                                            mb_strtoupper(
                                                mb_substr(
                                                    $parte,
                                                    0,
                                                    1
                                                )
                                            )
                                    )
                                    ->implode('');


                                    /*
                                    |--------------------------------------------------------------------------
                                    | ESTADO
                                    |--------------------------------------------------------------------------
                                    */

                                    $estadoLabel = match(
                                        $huesped->estado
                                    ) {

                                        'alojado' =>
                                            'Alojado',

                                        'reserva' =>
                                            'Reserva',

                                        'activo' =>
                                            'Activo',

                                        'inactivo' =>
                                            'Inactivo',

                                        default =>
                                            ucfirst(
                                                $huesped->estado
                                            ),

                                    };


                                    $estadoClase = match(
                                        $huesped->estado
                                    ) {

                                        'alojado' =>
                                            'staying',

                                        'reserva' =>
                                            'reservation',

                                        'activo' =>
                                            'active',

                                        default =>
                                            'inactive',

                                    };

                                @endphp


                                <tr>


                                    {{-- HUÉSPED --}}

                                    <td>

                                        <div class="guest-person">

                                            <div class="guest-avatar">

                                                {{ $iniciales ?: '?' }}

                                            </div>

                                            <div>

                                                <strong>
                                                    {{ $huesped->nombre }}
                                                </strong>

                                                <span>
                                                    {{ $huesped->email ?: 'Sin correo registrado' }}
                                                </span>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- DOCUMENTO --}}

                                    <td>

                                        <div class="guest-document">

                                            <strong>
                                                {{ $huesped->tipo_documento }}
                                            </strong>

                                            <span>
                                                {{ $huesped->numero_documento }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- TELÉFONO --}}

                                    <td>

                                        <span class="guest-phone">

                                            {{ $huesped->telefono ?: 'Sin teléfono' }}

                                        </span>

                                    </td>


                                    {{-- HABITACIÓN --}}

                                    <td>

                                        @if($huesped->habitacion)

                                            <span class="room-number">

                                                {{ $huesped->habitacion->numero }}

                                            </span>

                                        @else

                                            <span class="room-empty">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ESTADO --}}

                                    <td>

                                        <span
                                            class="guest-status {{ $estadoClase }}"
                                        >

                                            <span></span>

                                            {{ $estadoLabel }}

                                        </span>

                                    </td>


                                    {{-- FECHA --}}

                                    <td>

                                        <span class="guest-registration-date">

                                            {{ $huesped->fecha_registro?->format('d/m/Y') ?? '—' }}

                                        </span>

                                    </td>


                                    {{-- ACCIONES --}}

                                    <td>

                                        <div class="guest-actions">

                                            <a
                                                href="{{ route('huespedes.show', $huesped->id) }}"
                                                class="guest-action-button"
                                                title="Ver huésped"
                                            >
                                                <i class="fa-solid fa-eye"></i>
                                            </a>


                                            <a
                                                href="{{ route('huespedes.edit', $huesped->id) }}"
                                                class="guest-action-button"
                                                title="Editar huésped"
                                            >
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                        </div>

                                    </td>

                                </tr>


                            @empty


                                {{-- SIN REGISTROS --}}

                                <tr>

                                    <td
                                        colspan="7"
                                        class="guests-empty-row"
                                    >

                                        <div class="guests-empty-state">

                                            <div class="guests-empty-icon">
                                                <i class="fa-solid fa-users"></i>
                                            </div>

                                            <strong>
                                                No hay huéspedes registrados
                                            </strong>

                                            <span>
                                                Los huéspedes que registres
                                                aparecerán aquí.
                                            </span>

                                            <a
                                                href="{{ route('huespedes.create') }}"
                                                class="guest-primary-button"
                                            >
                                                <i class="fa-solid fa-plus"></i>
                                                Registrar huésped
                                            </a>

                                        </div>

                                    </td>

                                </tr>


                            @endforelse

                        </tbody>

                    </table>

                </div>



                {{-- =================================================
                     PIE DE TABLA
                ================================================== --}}

                @if($huespedes instanceof \Illuminate\Contracts\Pagination\Paginator)

                    <div class="guests-table-footer">

                        <span>

                            Mostrando

                            <strong>
                                {{ $huespedes->firstItem() ?? 0 }}
                                -
                                {{ $huespedes->lastItem() ?? 0 }}
                            </strong>

                            de

                            <strong>
                                {{ $huespedes->total() }}
                            </strong>

                            huéspedes

                        </span>


                        <div class="guest-pagination">

                            {{ $huespedes->links() }}

                        </div>

                    </div>

                @endif


            </div>

        </section>

    </main>

</div>


</x-app-layout>
```
