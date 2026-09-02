{{-- =========================================================
     LIMPIEZA
     resources/views/limpieza.blade.php
========================================================= --}}

<x-app-layout>

@vite(['resources/css/limpieza.css'])


    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    @if (false)
    <aside class="hotel-sidebar">


        {{-- LOGO --}}

        <div class="sidebar-logo">

            <div class="logo-icon">
                <i class="fa-solid fa-hotel"></i>
            </div>

            <div class="logo-text">

                <span class="logo-title">
                    HOTEL
                </span>

                <span class="logo-subtitle">
                    Management
                </span>

            </div>

        </div>


        {{-- =====================================================
             NAVEGACIÓN
        ====================================================== --}}

        <nav class="sidebar-navigation">


            <div class="navigation-title">
                PRINCIPAL
            </div>


            <a href="{{ route('dashboard') }}" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-chart-pie"></i>
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            <a href="{{ route('habitaciones.index') }}" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-bed"></i>
                </span>

                <span>
                    Habitaciones
                </span>

            </a>


            <a href="{{ route('huespedes.index') }}" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-users"></i>
                </span>

                <span>
                    Huéspedes
                </span>

            </a>


            <a href="{{ route('reservas.index') }}" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </span>

                <span>
                    Reservas
                </span>

            </a>


            <div class="navigation-title">
                OPERACIONES
            </div>


            <a href="{{ route('checkin.index') }}" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </span>

                <span>
                    Check-in
                </span>

            </a>


            <a href="{{ route('checkout.index') }}" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </span>

                <span>
                    Check-out
                </span>

            </a>


            {{-- LIMPIEZA ACTIVA --}}

            <a href="#" class="sidebar-link active">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-broom"></i>
                </span>

                <span>
                    Limpieza
                </span>

            </a>


            <a href="#" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-wallet"></i>
                </span>

                <span>
                    Pagos e ingresos
                </span>

            </a>


            <div class="navigation-title">
                ADMINISTRACIÓN
            </div>


            <a href="#" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-chart-column"></i>
                </span>

                <span>
                    Reportes
                </span>

            </a>


            <a href="#" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-gear"></i>
                </span>

                <span>
                    Configuración
                </span>

            </a>


        </nav>


        {{-- =====================================================
             USUARIO
        ====================================================== --}}

        <div class="sidebar-user">

            <div class="sidebar-user-avatar">

                <i class="fa-solid fa-user"></i>

            </div>


            <div class="sidebar-user-info">

                <span>
                    Administrador
                </span>

            </div>


            <button class="sidebar-user-menu">

                <i class="fa-solid fa-ellipsis-vertical"></i>

            </button>

        </div>


    </aside>
    @endif



    {{-- =========================================================
         CONTENIDO PRINCIPAL
    ========================================================== --}}

    <main class="hotel-main">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="hotel-header">


            <div class="header-left">

                <div class="page-heading">

                    <span class="page-section">
                        OPERACIONES
                    </span>

                    <h1>
                        Limpieza
                    </h1>

                    <p>
                        Gestiona el estado de limpieza de las habitaciones.
                    </p>

                </div>

            </div>


            <div class="header-right">


                {{-- NOTIFICACIONES --}}

                <button class="header-icon-button">

                    <i class="fa-regular fa-bell"></i>

                    <span class="notification-dot"></span>

                </button>


                {{-- USUARIO --}}

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



        {{-- =====================================================
             CABECERA DEL MÓDULO
        ====================================================== --}}

        <section class="cleaning-page-header">


            <div>

                <span class="cleaning-eyebrow">
                    CONTROL OPERATIVO
                </span>

                <h2>
                    Estado de limpieza
                </h2>

                <p>
                    Supervisa y actualiza el estado de las habitaciones
                    pendientes de limpieza.
                </p>

            </div>


            <button class="primary-action">

                <i class="fa-solid fa-broom"></i>

                Gestionar limpieza

            </button>


        </section>



        {{-- =====================================================
             RESUMEN
        ====================================================== --}}

        <section class="cleaning-summary">


            {{-- PENDIENTES --}}

            <div class="summary-card pending">

                <div class="summary-icon">

                    <i class="fa-solid fa-broom"></i>

                </div>


                <div class="summary-content">

                    <span class="summary-label">
                        PENDIENTES
                    </span>

                    <strong>
                        --
                    </strong>

                    <small>
                        Habitaciones esperando limpieza
                    </small>

                </div>

            </div>



            {{-- LIMPIAS --}}

            <div class="summary-card clean">

                <div class="summary-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>


                <div class="summary-content">

                    <span class="summary-label">
                        LIMPIAS
                    </span>

                    <strong>
                        --
                    </strong>

                    <small>
                        Habitaciones disponibles
                    </small>

                </div>

            </div>



            {{-- EN PROCESO --}}

            <div class="summary-card process">

                <div class="summary-icon">

                    <i class="fa-solid fa-spinner"></i>

                </div>


                <div class="summary-content">

                    <span class="summary-label">
                        EN PROCESO
                    </span>

                    <strong>
                        --
                    </strong>

                    <small>
                        Limpiezas en ejecución
                    </small>

                </div>

            </div>



            {{-- ATENCIÓN --}}

            <div class="summary-card urgent">

                <div class="summary-icon">

                    <i class="fa-solid fa-triangle-exclamation"></i>

                </div>


                <div class="summary-content">

                    <span class="summary-label">
                        ATENCIÓN
                    </span>

                    <strong>
                        --
                    </strong>

                    <small>
                        Habitaciones que requieren revisión
                    </small>

                </div>

            </div>


        </section>



        {{-- =====================================================
             FILTROS
        ====================================================== --}}

        <section class="cleaning-filters">


            <div class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    placeholder="Buscar habitación..."
                    autocomplete="off"
                >

            </div>


            <div class="filter-group">

                <label>
                    Estado
                </label>

                <select>

                    <option>
                        Todos los estados
                    </option>

                    <option>
                        Limpia
                    </option>

                    <option>
                        Pendiente
                    </option>

                    <option>
                        En proceso
                    </option>

                    <option>
                        Atención
                    </option>

                </select>

            </div>


            <div class="filter-group">

                <label>
                    Prioridad
                </label>

                <select>

                    <option>
                        Todas
                    </option>

                    <option>
                        Normal
                    </option>

                    <option>
                        Alta
                    </option>

                    <option>
                        Urgente
                    </option>

                </select>

            </div>


        </section>



        {{-- =====================================================
             FILTROS RÁPIDOS
        ====================================================== --}}

        <div class="quick-filters">

            <button class="quick-filter active">
                Todas
            </button>

            <button class="quick-filter">
                Pendientes
            </button>

            <button class="quick-filter">
                En proceso
            </button>

            <button class="quick-filter">
                Limpias
            </button>

            <button class="quick-filter">
                Atención
            </button>

        </div>



        {{-- =====================================================
             HABITACIONES
        ====================================================== --}}

        <section class="rooms-section">


            <div class="section-heading">

                <div>

                    <span class="section-label">
                        HABITACIONES
                    </span>

                    <h3>
                        Estado actual
                    </h3>

                </div>


                <span class="rooms-count">
                    Habitaciones registradas
                </span>

            </div>



            {{-- =================================================
                 GRID PREPARADO PARA BD
            ================================================== --}}

            <div class="cleaning-rooms-grid">


                {{-- HABITACIÓN --}}

                <button class="cleaning-room-card clean">

                    <span class="room-number">
                        --
                    </span>

                    <span class="room-status-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>

                    <span class="room-status">
                        LIMPIA
                    </span>

                </button>


                <button class="cleaning-room-card pending">

                    <span class="room-number">
                        --
                    </span>

                    <span class="room-status-icon">
                        <i class="fa-solid fa-broom"></i>
                    </span>

                    <span class="room-status">
                        PENDIENTE
                    </span>

                </button>


                <button class="cleaning-room-card process">

                    <span class="room-number">
                        --
                    </span>

                    <span class="room-status-icon">
                        <i class="fa-solid fa-spinner"></i>
                    </span>

                    <span class="room-status">
                        EN PROCESO
                    </span>

                </button>


                <button class="cleaning-room-card urgent">

                    <span class="room-number">
                        --
                    </span>

                    <span class="room-status-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </span>

                    <span class="room-status">
                        ATENCIÓN
                    </span>

                </button>


            </div>

        </section>



        {{-- =====================================================
             INFORMACIÓN OPERATIVA
        ====================================================== --}}

        <section class="cleaning-information">


            <div class="information-card">

                <div class="information-icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>


                <div>

                    <strong>
                        Gestión de habitaciones
                    </strong>

                    <p>
                        Selecciona una habitación para consultar su estado,
                        asignar personal de limpieza o actualizar su condición.
                    </p>

                </div>

            </div>


            <div class="information-card">

                <div class="information-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>


                <div>

                    <strong>
                        Seguimiento
                    </strong>

                    <p>
                        El sistema permitirá registrar cuándo comenzó
                        y cuándo terminó cada proceso de limpieza.
                    </p>

                </div>

            </div>


        </section>


    </main>

</x-app-layout>