{{-- =========================================================
     MANTENIMIENTO
     resources/views/mantenimiento.blade.php
========================================================= --}}

<x-app-layout>

    @vite(['resources/css/mantenimiento.css'])

    {{-- =====================================================
         CONTENEDOR PRINCIPAL
    ====================================================== --}}
    <div class="maintenance-page">

        {{-- =================================================
             SIDEBAR
        ================================================== --}}
        @if (false)
        <aside class="hotel-sidebar">

            {{-- LOGO --}}
            <div class="sidebar-logo">

                <div class="logo-icon">
                    <i class="fa-solid fa-hotel"></i>
                </div>

                <div class="logo-text">
                    <span class="logo-title">HOTEL</span>
                    <span class="logo-subtitle">Management</span>
                </div>

            </div>


            {{-- NAVEGACIÓN --}}
            <nav class="sidebar-navigation">

                <div class="navigation-title">
                    PRINCIPAL
                </div>

                <a href="{{ route('dashboard') }}" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-chart-pie"></i>
                    </span>

                    <span>Dashboard</span>

                </a>


                <a href="{{ route('habitaciones.index') }}" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-bed"></i>
                    </span>

                    <span>Habitaciones</span>

                </a>


                <a href="{{ route('huespedes.index') }}" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-users"></i>
                    </span>

                    <span>Huéspedes</span>

                </a>


                <a href="{{ route('reservas.index') }}" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </span>

                    <span>Reservas</span>

                </a>


                <div class="navigation-title">
                    OPERACIONES
                </div>


                <a href="{{ route('checkin.index') }}" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </span>

                    <span>Check-in</span>

                </a>


                <a href="{{ route('checkout.index') }}" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>

                    <span>Check-out</span>

                </a>


                <a href="#" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-wallet"></i>
                    </span>

                    <span>Pagos e ingresos</span>

                </a>


                <a href="{{ route('limpieza.index') }}" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-broom"></i>
                    </span>

                    <span>Limpieza</span>

                </a>


                {{-- MANTENIMIENTO ACTIVO --}}
                <a href="{{ route('mantenimiento.index') }}"
                   class="sidebar-link active">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </span>

                    <span>Mantenimiento</span>

                </a>


                <div class="navigation-title">
                    ADMINISTRACIÓN
                </div>


                <a href="#" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-chart-column"></i>
                    </span>

                    <span>Reportes</span>

                </a>


                <a href="#" class="sidebar-link">

                    <span class="sidebar-link-icon">
                        <i class="fa-solid fa-gear"></i>
                    </span>

                    <span>Configuración</span>

                </a>

            </nav>


            {{-- USUARIO --}}
            <div class="sidebar-user">

                <div class="sidebar-user-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="sidebar-user-info">
                    <span>Administrador</span>
                    <small>Sesión activa</small>
                </div>

                <button class="sidebar-user-menu">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>

            </div>

        </aside>
        @endif


        {{-- =================================================
             ÁREA PRINCIPAL
        ================================================== --}}
        <main class="maintenance-main">


            {{-- =================================================
                 HEADER
            ================================================== --}}
            <header class="hotel-header">

                <div class="header-left">

                    <div class="page-heading">

                        <div class="page-heading-icon">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </div>

                        <div>

                            <h1>
                                Mantenimiento
                            </h1>

                            <p>
                                Gestión de incidencias y mantenimiento del hotel.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="header-right">

                    <button class="header-icon-button">

                        <i class="fa-regular fa-bell"></i>

                        <span class="notification-dot"></span>

                    </button>


                    <div class="header-user">

                        <div class="header-user-avatar">
                            A
                        </div>

                        <div class="header-user-info">

                            <strong>
                                Administrador
                            </strong>

                        </div>

                        <i class="fa-solid fa-chevron-down"></i>

                    </div>

                </div>

            </header>


            {{-- =================================================
                 CONTENIDO
            ================================================== --}}
            <div class="maintenance-content">


                {{-- =================================================
                     ENCABEZADO
                ================================================== --}}
                <section class="maintenance-page-title">

                    <div>

                        <span class="maintenance-section-label">
                            CONTROL DEL HOTEL
                        </span>

                        <h2>
                            Mantenimiento
                        </h2>

                        <p>
                            Registra, supervisa y controla las incidencias
                            y trabajos de mantenimiento.
                        </p>

                    </div>


                    <button type="button"
                            class="maintenance-primary-button"
                            id="btnNuevoMantenimiento">

                        <i class="fa-solid fa-plus"></i>

                        Nuevo mantenimiento

                    </button>

                </section>


                {{-- =================================================
                     TARJETAS DE RESUMEN
                ================================================== --}}
                <section class="maintenance-summary">


                    {{-- PENDIENTES --}}
                    <div class="maintenance-summary-card card-pending">

                        <div class="summary-icon">

                            <i class="fa-solid fa-clock"></i>

                        </div>

                        <div class="summary-information">

                            <span>
                                Pendientes
                            </span>

                            <strong id="totalPendientes">
                                0
                            </strong>

                            <small>
                                Requieren atención
                            </small>

                        </div>

                    </div>


                    {{-- EN PROCESO --}}
                    <div class="maintenance-summary-card card-process">

                        <div class="summary-icon">

                            <i class="fa-solid fa-screwdriver-wrench"></i>

                        </div>

                        <div class="summary-information">

                            <span>
                                En proceso
                            </span>

                            <strong id="totalProceso">
                                0
                            </strong>

                            <small>
                                Trabajos activos
                            </small>

                        </div>

                    </div>


                    {{-- COMPLETADOS --}}
                    <div class="maintenance-summary-card card-completed">

                        <div class="summary-icon">

                            <i class="fa-solid fa-circle-check"></i>

                        </div>

                        <div class="summary-information">

                            <span>
                                Completados
                            </span>

                            <strong id="totalCompletados">
                                0
                            </strong>

                            <small>
                                Trabajos finalizados
                            </small>

                        </div>

                    </div>


                    {{-- URGENTES --}}
                    <div class="maintenance-summary-card card-urgent">

                        <div class="summary-icon">

                            <i class="fa-solid fa-triangle-exclamation"></i>

                        </div>

                        <div class="summary-information">

                            <span>
                                Urgentes
                            </span>

                            <strong id="totalUrgentes">
                                0
                            </strong>

                            <small>
                                Prioridad alta
                            </small>

                        </div>

                    </div>

                </section>


                {{-- =================================================
                     FILTROS
                ================================================== --}}
                <section class="maintenance-filters">


                    <div class="maintenance-search">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            id="buscarMantenimiento"
                            name="buscar"
                            placeholder="Buscar habitación, incidencia o responsable..."
                        >

                    </div>


                    <div class="maintenance-filter">

                        <label for="filtroEstado">
                            Estado
                        </label>

                        <select id="filtroEstado"
                                name="estado">

                            <option value="">
                                Todos
                            </option>

                            <option value="pendiente">
                                Pendiente
                            </option>

                            <option value="proceso">
                                En proceso
                            </option>

                            <option value="completado">
                                Completado
                            </option>

                        </select>

                    </div>


                    <div class="maintenance-filter">

                        <label for="filtroPrioridad">
                            Prioridad
                        </label>

                        <select id="filtroPrioridad"
                                name="prioridad">

                            <option value="">
                                Todas
                            </option>

                            <option value="alta">
                                Alta
                            </option>

                            <option value="media">
                                Media
                            </option>

                            <option value="baja">
                                Baja
                            </option>

                        </select>

                    </div>


                    <div class="maintenance-filter">

                        <label for="filtroTipo">
                            Tipo
                        </label>

                        <select id="filtroTipo"
                                name="tipo">

                            <option value="">
                                Todos
                            </option>

                            <option value="electrico">
                                Eléctrico
                            </option>

                            <option value="fontaneria">
                                Fontanería
                            </option>

                            <option value="climatizacion">
                                Climatización
                            </option>

                            <option value="infraestructura">
                                Infraestructura
                            </option>

                            <option value="equipamiento">
                                Equipamiento
                            </option>

                        </select>

                    </div>


                    <button type="button"
                            class="maintenance-filter-button">

                        <i class="fa-solid fa-filter"></i>

                        Filtrar

                    </button>

                </section>


                {{-- =================================================
                     PANEL PRINCIPAL
                ================================================== --}}
                <section class="maintenance-grid">


                    {{-- =================================================
                         TABLA DE MANTENIMIENTOS
                    ================================================== --}}
                    <div class="maintenance-panel">

                        <div class="maintenance-panel-header">

                            <div>

                                <h3>
                                    Mantenimientos registrados
                                </h3>

                                <p>
                                    Control de incidencias y trabajos realizados.
                                </p>

                            </div>


                            <button type="button"
                                    class="panel-options-button">

                                <i class="fa-solid fa-ellipsis"></i>

                            </button>

                        </div>


                        <div class="maintenance-table-container">

                            <table class="maintenance-table">

                                <thead>

                                    <tr>

                                        <th>
                                            Código
                                        </th>

                                        <th>
                                            Incidencia
                                        </th>

                                        <th>
                                            Ubicación
                                        </th>

                                        <th>
                                            Tipo
                                        </th>

                                        <th>
                                            Prioridad
                                        </th>

                                        <th>
                                            Responsable
                                        </th>

                                        <th>
                                            Estado
                                        </th>

                                        <th>
                                            Fecha
                                        </th>

                                        <th>
                                            Acciones
                                        </th>

                                    </tr>

                                </thead>


                                <tbody id="mantenimientosTableBody">

                                    {{--

                                    AQUÍ SE CONECTARÁ LA BD:

                                    @forelse($mantenimientos as $mantenimiento)

                                        <tr>

                                            <td>
                                                {{ $mantenimiento->codigo }}
                                            </td>

                                            <td>
                                                {{ $mantenimiento->incidencia }}
                                            </td>

                                            <td>
                                                {{ $mantenimiento->ubicacion }}
                                            </td>

                                            <td>
                                                {{ $mantenimiento->tipo }}
                                            </td>

                                            <td>
                                                ...
                                            </td>

                                        </tr>

                                    @empty

                                    --}}


                                    <tr id="emptyMaintenanceRow">

                                        <td colspan="9">

                                            <div class="maintenance-empty">

                                                <div class="maintenance-empty-icon">

                                                    <i class="fa-solid fa-screwdriver-wrench"></i>

                                                </div>

                                                <strong>
                                                    No hay mantenimientos registrados
                                                </strong>

                                                <span>
                                                    Los registros aparecerán aquí cuando se agreguen.
                                                </span>

                                            </div>

                                        </td>

                                    </tr>


                                    {{--

                                    @endforelse

                                    --}}

                                </tbody>

                            </table>

                        </div>

                    </div>


                    {{-- =================================================
                         PANEL LATERAL
                    ================================================== --}}
                    <aside class="maintenance-side-panel">


                        {{-- ESTADO --}}
                        <div class="maintenance-panel side-panel">

                            <div class="maintenance-panel-header">

                                <div>

                                    <h3>
                                        Estado actual
                                    </h3>

                                    <p>
                                        Resumen de incidencias.
                                    </p>

                                </div>

                            </div>


                            <div class="maintenance-status-list">


                                <div class="maintenance-status-item">

                                    <div class="status-color status-red"></div>

                                    <div>

                                        <strong>
                                            Prioridad alta
                                        </strong>

                                        <span>
                                            Atención inmediata
                                        </span>

                                    </div>

                                    <strong id="statusAlta">
                                        0
                                    </strong>

                                </div>


                                <div class="maintenance-status-item">

                                    <div class="status-color status-orange"></div>

                                    <div>

                                        <strong>
                                            Prioridad media
                                        </strong>

                                        <span>
                                            Atención programada
                                        </span>

                                    </div>

                                    <strong id="statusMedia">
                                        0
                                    </strong>

                                </div>


                                <div class="maintenance-status-item">

                                    <div class="status-color status-green"></div>

                                    <div>

                                        <strong>
                                            Prioridad baja
                                        </strong>

                                        <span>
                                            Sin urgencia
                                        </span>

                                    </div>

                                    <strong id="statusBaja">
                                        0
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- HABITACIONES AFECTADAS --}}
                        <div class="maintenance-panel side-panel">

                            <div class="maintenance-panel-header">

                                <div>

                                    <h3>
                                        Habitaciones afectadas
                                    </h3>

                                    <p>
                                        Habitaciones con incidencias.
                                    </p>

                                </div>

                            </div>


                            <div class="affected-rooms">

                                <div class="affected-empty">

                                    <div class="affected-empty-icon">

                                        <i class="fa-solid fa-bed"></i>

                                    </div>

                                    <strong>
                                        Sin incidencias
                                    </strong>

                                    <span>
                                        No hay habitaciones afectadas.
                                    </span>

                                </div>

                            </div>

                        </div>

                    </aside>

                </section>


                {{-- =================================================
                     TIPOS DE MANTENIMIENTO
                ================================================== --}}
                <section class="maintenance-types-panel">


                    <div class="maintenance-panel-header">

                        <div>

                            <h3>
                                Categorías de mantenimiento
                            </h3>

                            <p>
                                Selecciona una categoría para consultar o registrar trabajos.
                            </p>

                        </div>

                    </div>


                    <div class="maintenance-types-grid">


                        <button type="button"
                                class="maintenance-type-card">

                            <span class="type-icon blue">
                                <i class="fa-solid fa-bolt"></i>
                            </span>

                            <span class="type-information">

                                <strong>
                                    Eléctrico
                                </strong>

                                <small>
                                    Instalaciones eléctricas
                                </small>

                            </span>

                        </button>


                        <button type="button"
                                class="maintenance-type-card">

                            <span class="type-icon orange">
                                <i class="fa-solid fa-faucet"></i>
                            </span>

                            <span class="type-information">

                                <strong>
                                    Fontanería
                                </strong>

                                <small>
                                    Agua y tuberías
                                </small>

                            </span>

                        </button>


                        <button type="button"
                                class="maintenance-type-card">

                            <span class="type-icon purple">
                                <i class="fa-solid fa-snowflake"></i>
                            </span>

                            <span class="type-information">

                                <strong>
                                    Climatización
                                </strong>

                                <small>
                                    Aire acondicionado
                                </small>

                            </span>

                        </button>


                        <button type="button"
                                class="maintenance-type-card">

                            <span class="type-icon green">
                                <i class="fa-solid fa-building"></i>
                            </span>

                            <span class="type-information">

                                <strong>
                                    Infraestructura
                                </strong>

                                <small>
                                    Instalaciones físicas
                                </small>

                            </span>

                        </button>


                        <button type="button"
                                class="maintenance-type-card">

                            <span class="type-icon red">
                                <i class="fa-solid fa-toolbox"></i>
                            </span>

                            <span class="type-information">

                                <strong>
                                    Equipamiento
                                </strong>

                                <small>
                                    Equipos y mobiliario
                                </small>

                            </span>

                        </button>


                    </div>

                </section>

            </div>

        </main>

    </div>


    {{-- =========================================================
         CSS MEDIANTE VITE
    ========================================================== --}}
    @vite(['resources/css/mantenimiento.css'])

</x-app-layout>