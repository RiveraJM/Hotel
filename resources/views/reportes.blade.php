{{-- =========================================================
     REPORTES
     resources/views/reportes.blade.php
========================================================= --}}

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reportes | Hotel Management</title>

    @vite(['resources/css/reportes.css'])

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>


<body>

<div class="hotel-layout">

    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    <aside class="hotel-sidebar">

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


        <nav class="sidebar-navigation">

            <div class="navigation-title">
                PRINCIPAL
            </div>


            <a href="{{ route('dashboard') }}"
               class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-chart-pie"></i>
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            <a href="{{ route('habitaciones.index') }}"
               class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-bed"></i>
                </span>

                <span>
                    Habitaciones
                </span>

            </a>


            <a href="{{ route('huespedes.index') }}"
               class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-users"></i>
                </span>

                <span>
                    Huéspedes
                </span>

            </a>


            <a href="{{ route('reservas.index') }}"
               class="sidebar-link">

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


            <a href="{{ route('checkin.index') }}"
               class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </span>

                <span>
                    Check-in
                </span>

            </a>


            <a href="{{ route('checkout.index') }}"
               class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </span>

                <span>
                    Check-out
                </span>

            </a>


            <a href="#"
               class="sidebar-link">

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


            <a href="#"
               class="sidebar-link active">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-chart-column"></i>
                </span>

                <span>
                    Reportes
                </span>

            </a>


            <a href="#"
               class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-gear"></i>
                </span>

                <span>
                    Configuración
                </span>

            </a>

        </nav>


        <div class="sidebar-user">

            <div class="sidebar-user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="sidebar-user-info">

                <strong>
                    Administrador
                </strong>

                <span>
                    Sesión activa
                </span>

            </div>

            <button class="sidebar-user-menu">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>

        </div>

    </aside>



    {{-- =========================================================
         CONTENIDO PRINCIPAL
    ========================================================== --}}

    <main class="reports-main">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="hotel-header">

            <div class="header-left">

                <div>

                    <span class="header-section">
                        ADMINISTRACIÓN
                    </span>

                    <h1>
                        Reportes
                    </h1>

                    <p>
                        Analiza el rendimiento y la operación del hotel.
                    </p>

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

                        <span>
                            Sesión activa
                        </span>

                    </div>

                    <i class="fa-solid fa-chevron-down"></i>

                </div>

            </div>

        </header>



        {{-- =====================================================
             CONTENIDO
        ====================================================== --}}

        <section class="reports-content">


            {{-- =================================================
                 CABECERA DEL REPORTE
            ================================================== --}}

            <div class="reports-heading">

                <div>

                    <span class="content-label">
                        CENTRO DE ANÁLISIS
                    </span>

                    <h2>
                        Resumen operativo
                    </h2>

                    <p>
                        Consulta los principales indicadores del hotel
                        y analiza su comportamiento.
                    </p>

                </div>


                <div class="reports-actions">

                    <button type="button"
                            class="report-action secondary">

                        <i class="fa-solid fa-file-pdf"></i>

                        Exportar PDF

                    </button>


                    <button type="button"
                            class="report-action primary">

                        <i class="fa-solid fa-file-excel"></i>

                        Exportar Excel

                    </button>

                </div>

            </div>



            {{-- =================================================
                 FILTROS
            ================================================== --}}

            <div class="report-filters">

                <div class="filter-group">

                    <label>
                        Período
                    </label>

                    <select>

                        <option>
                            Este mes
                        </option>

                        <option>
                            Este año
                        </option>

                        <option>
                            Últimos 7 días
                        </option>

                        <option>
                            Últimos 30 días
                        </option>

                        <option>
                            Personalizado
                        </option>

                    </select>

                </div>


                <div class="filter-group">

                    <label>
                        Desde
                    </label>

                    <input type="date">

                </div>


                <div class="filter-group">

                    <label>
                        Hasta
                    </label>

                    <input type="date">

                </div>


                <button type="button"
                        class="filter-button">

                    <i class="fa-solid fa-filter"></i>

                    Aplicar filtros

                </button>

            </div>



            {{-- =================================================
                 INDICADORES PRINCIPALES
            ================================================== --}}

            <div class="report-summary">


                <div class="summary-card">

                    <div class="summary-icon blue">
                        <i class="fa-solid fa-bed"></i>
                    </div>

                    <div class="summary-information">

                        <span>
                            Ocupación
                        </span>

                        <strong>
                            --
                        </strong>

                        <small>
                            % de habitaciones ocupadas
                        </small>

                    </div>

                </div>



                <div class="summary-card">

                    <div class="summary-icon green">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                    </div>

                    <div class="summary-information">

                        <span>
                            Ingresos
                        </span>

                        <strong>
                            S/ --
                        </strong>

                        <small>
                            Ingresos del período
                        </small>

                    </div>

                </div>



                <div class="summary-card">

                    <div class="summary-icon orange">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>

                    <div class="summary-information">

                        <span>
                            Reservas
                        </span>

                        <strong>
                            --
                        </strong>

                        <small>
                            Reservas registradas
                        </small>

                    </div>

                </div>



                <div class="summary-card">

                    <div class="summary-icon purple">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <div class="summary-information">

                        <span>
                            Huéspedes
                        </span>

                        <strong>
                            --
                        </strong>

                        <small>
                            Huéspedes atendidos
                        </small>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 GRÁFICOS PRINCIPALES
            ================================================== --}}

            <div class="reports-grid">


                {{-- OCUPACIÓN --}}

                <div class="report-panel large">

                    <div class="panel-header">

                        <div>

                            <span class="panel-label">
                                HABITACIONES
                            </span>

                            <h3>
                                Ocupación del hotel
                            </h3>

                        </div>

                        <button class="panel-menu">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>

                    </div>


                    <div class="chart-area">

                        <div class="chart-placeholder">

                            <i class="fa-solid fa-chart-line"></i>

                            <span>
                                Gráfico de ocupación
                            </span>

                            <small>
                                Se conectará con los datos reales
                                de habitaciones y reservas.
                            </small>

                        </div>

                    </div>

                </div>



                {{-- INGRESOS --}}

                <div class="report-panel">

                    <div class="panel-header">

                        <div>

                            <span class="panel-label">
                                FINANZAS
                            </span>

                            <h3>
                                Ingresos
                            </h3>

                        </div>

                        <button class="panel-menu">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>

                    </div>


                    <div class="chart-area">

                        <div class="chart-placeholder">

                            <i class="fa-solid fa-chart-column"></i>

                            <span>
                                Gráfico de ingresos
                            </span>

                            <small>
                                Reservas, hospedaje y servicios.
                            </small>

                        </div>

                    </div>

                </div>



                {{-- RESERVAS --}}

                <div class="report-panel">

                    <div class="panel-header">

                        <div>

                            <span class="panel-label">
                                RESERVAS
                            </span>

                            <h3>
                                Estado de reservas
                            </h3>

                        </div>

                    </div>


                    <div class="donut-container">

                        <div class="donut-chart">

                            <div class="donut-center">

                                <strong>
                                    --
                                </strong>

                                <span>
                                    Reservas
                                </span>

                            </div>

                        </div>


                        <div class="chart-legend">

                            <div>
                                <span class="legend-dot confirmed"></span>
                                Confirmadas
                            </div>

                            <div>
                                <span class="legend-dot pending"></span>
                                Pendientes
                            </div>

                            <div>
                                <span class="legend-dot cancelled"></span>
                                Canceladas
                            </div>

                        </div>

                    </div>

                </div>



                {{-- CHECK-IN / CHECK-OUT --}}

                <div class="report-panel">

                    <div class="panel-header">

                        <div>

                            <span class="panel-label">
                                OPERACIONES
                            </span>

                            <h3>
                                Entradas y salidas
                            </h3>

                        </div>

                    </div>


                    <div class="operation-stats">

                        <div class="operation-stat">

                            <div class="operation-icon checkin">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>

                            <div>

                                <strong>
                                    --
                                </strong>

                                <span>
                                    Check-in
                                </span>

                            </div>

                        </div>


                        <div class="operation-stat">

                            <div class="operation-icon checkout">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </div>

                            <div>

                                <strong>
                                    --
                                </strong>

                                <span>
                                    Check-out
                                </span>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- MÉTODOS DE PAGO --}}

                <div class="report-panel">

                    <div class="panel-header">

                        <div>

                            <span class="panel-label">
                                CAJA
                            </span>

                            <h3>
                                Métodos de pago
                            </h3>

                        </div>

                    </div>


                    <div class="payment-report">

                        <div class="payment-row">

                            <div>

                                <span>
                                    <i class="fa-solid fa-money-bill"></i>
                                    Efectivo
                                </span>

                                <strong>
                                    --%
                                </strong>

                            </div>

                            <div class="progress">

                                <span style="width: 0%;"></span>

                            </div>

                        </div>


                        <div class="payment-row">

                            <div>

                                <span>
                                    <i class="fa-solid fa-credit-card"></i>
                                    Tarjeta
                                </span>

                                <strong>
                                    --%
                                </strong>

                            </div>

                            <div class="progress">

                                <span style="width: 0%;"></span>

                            </div>

                        </div>


                        <div class="payment-row">

                            <div>

                                <span>
                                    <i class="fa-solid fa-building-columns"></i>
                                    Transferencia
                                </span>

                                <strong>
                                    --%
                                </strong>

                            </div>

                            <div class="progress">

                                <span style="width: 0%;"></span>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- LIMPIEZA --}}

                <div class="report-panel">

                    <div class="panel-header">

                        <div>

                            <span class="panel-label">
                                SERVICIOS
                            </span>

                            <h3>
                                Limpieza
                            </h3>

                        </div>

                    </div>


                    <div class="service-report">

                        <div class="service-number">
                            --
                        </div>

                        <div>

                            <strong>
                                Habitaciones atendidas
                            </strong>

                            <span>
                                Durante el período seleccionado
                            </span>

                        </div>

                    </div>


                    <div class="service-report">

                        <div class="service-number">
                            --
                        </div>

                        <div>

                            <strong>
                                Pendientes
                            </strong>

                            <span>
                                Habitaciones pendientes de limpieza
                            </span>

                        </div>

                    </div>

                </div>



                {{-- MANTENIMIENTO --}}

                <div class="report-panel">

                    <div class="panel-header">

                        <div>

                            <span class="panel-label">
                                MANTENIMIENTO
                            </span>

                            <h3>
                                Incidencias
                            </h3>

                        </div>

                    </div>


                    <div class="maintenance-report">

                        <div class="maintenance-item">

                            <span class="maintenance-indicator open"></span>

                            <div>

                                <strong>
                                    Incidencias abiertas
                                </strong>

                                <span>
                                    Pendientes de atención
                                </span>

                            </div>

                            <b>
                                --
                            </b>

                        </div>


                        <div class="maintenance-item">

                            <span class="maintenance-indicator resolved"></span>

                            <div>

                                <strong>
                                    Incidencias resueltas
                                </strong>

                                <span>
                                    Atendidas durante el período
                                </span>

                            </div>

                            <b>
                                --
                            </b>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 RENDIMIENTO DE HABITACIONES
            ================================================== --}}

            <div class="report-panel rooms-performance">

                <div class="panel-header">

                    <div>

                        <span class="panel-label">
                            HABITACIONES
                        </span>

                        <h3>
                            Rendimiento de habitaciones
                        </h3>

                        <p>
                            Consulta qué habitaciones generan mayor
                            actividad e ingresos.
                        </p>

                    </div>


                    <button class="panel-menu">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>

                </div>


                <div class="performance-table-wrapper">

                    <table class="performance-table">

                        <thead>

                            <tr>

                                <th>
                                    Habitación
                                </th>

                                <th>
                                    Reservas
                                </th>

                                <th>
                                    Noches
                                </th>

                                <th>
                                    Ocupación
                                </th>

                                <th>
                                    Ingresos
                                </th>

                                <th>
                                    Rendimiento
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <tr>

                                <td>
                                    <strong>--</strong>
                                </td>

                                <td>--</td>

                                <td>--</td>

                                <td>--%</td>

                                <td>
                                    S/ --
                                </td>

                                <td>

                                    <span class="performance-badge">
                                        --
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>--</strong>
                                </td>

                                <td>--</td>

                                <td>--</td>

                                <td>--%</td>

                                <td>
                                    S/ --
                                </td>

                                <td>

                                    <span class="performance-badge">
                                        --
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>--</strong>
                                </td>

                                <td>--</td>

                                <td>--</td>

                                <td>--%</td>

                                <td>
                                    S/ --
                                </td>

                                <td>

                                    <span class="performance-badge">
                                        --
                                    </span>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>



            {{-- =================================================
                 TIPOS DE REPORTES
            ================================================== --}}

            <div class="available-reports">

                <div class="available-reports-heading">

                    <div>

                        <span class="content-label">
                            REPORTES DETALLADOS
                        </span>

                        <h2>
                            Información del sistema
                        </h2>

                    </div>

                </div>


                <div class="report-links">


                    <button class="report-link">

                        <span class="report-link-icon blue">
                            <i class="fa-solid fa-bed"></i>
                        </span>

                        <span>

                            <strong>
                                Reporte de habitaciones
                            </strong>

                            <small>
                                Ocupación, disponibilidad y rendimiento.
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>



                    <button class="report-link">

                        <span class="report-link-icon orange">
                            <i class="fa-solid fa-calendar-days"></i>
                        </span>

                        <span>

                            <strong>
                                Reporte de reservas
                            </strong>

                            <small>
                                Reservas confirmadas, pendientes y canceladas.
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>



                    <button class="report-link">

                        <span class="report-link-icon green">
                            <i class="fa-solid fa-money-bill-trend-up"></i>
                        </span>

                        <span>

                            <strong>
                                Reporte financiero
                            </strong>

                            <small>
                                Ingresos, pagos y movimientos de caja.
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>



                    <button class="report-link">

                        <span class="report-link-icon purple">
                            <i class="fa-solid fa-users"></i>
                        </span>

                        <span>

                            <strong>
                                Reporte de huéspedes
                            </strong>

                            <small>
                                Historial, frecuencia y comportamiento.
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>



                    <button class="report-link">

                        <span class="report-link-icon cyan">
                            <i class="fa-solid fa-broom"></i>
                        </span>

                        <span>

                            <strong>
                                Reporte de limpieza
                            </strong>

                            <small>
                                Habitaciones atendidas y pendientes.
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>



                    <button class="report-link">

                        <span class="report-link-icon red">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </span>

                        <span>

                            <strong>
                                Reporte de mantenimiento
                            </strong>

                            <small>
                                Incidencias y trabajos realizados.
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>

                </div>

            </div>

        </section>

    </main>

</div>

</body>

</html>