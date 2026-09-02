{{-- =========================================================
     CAJA
     resources/views/caja.blade.php
========================================================= --}}

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Caja | Hotel Management</title>

    {{-- Carga correcta mediante Vite --}}
    @vite(['resources/css/caja.css'])

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
                <span class="logo-title">HOTEL</span>
                <span class="logo-subtitle">Management</span>
            </div>

        </div>


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


            <a href="#" class="sidebar-link active">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-cash-register"></i>
                </span>

                <span>Caja</span>

            </a>


            <a href="#" class="sidebar-link">

                <span class="sidebar-link-icon">
                    <i class="fa-solid fa-broom"></i>
                </span>

                <span>Limpieza</span>

            </a>


            <a href="#" class="sidebar-link">

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

                <strong>Administrador</strong>

                <span>Sesión activa</span>

            </div>

            <button class="sidebar-user-menu">

                <i class="fa-solid fa-ellipsis-vertical"></i>

            </button>

        </div>

    </aside>



    {{-- =========================================================
         CONTENIDO PRINCIPAL
    ========================================================== --}}

    <main class="hotel-main">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="hotel-header">


            <div class="header-left">

                <div class="header-page">

                    <span class="header-section">
                        OPERACIONES
                    </span>

                    <h1>
                        Caja
                    </h1>

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
                            Administrador
                        </span>

                    </div>

                    <i class="fa-solid fa-chevron-down"></i>

                </div>

            </div>

        </header>



        {{-- =====================================================
             CONTENIDO
        ====================================================== --}}

        <section class="caja-content">


            {{-- =================================================
                 TÍTULO
            ================================================== --}}

            <div class="page-introduction">


                <div>

                    <span class="page-kicker">
                        CONTROL FINANCIERO
                    </span>

                    <h2>
                        Caja
                    </h2>

                    <p>
                        Administra los ingresos, egresos y movimientos
                        financieros diarios del hotel.
                    </p>

                </div>


                <div class="page-actions">

                    <button class="btn btn-outline">

                        <i class="fa-solid fa-clock-rotate-left"></i>

                        Historial

                    </button>


                    <button class="btn btn-primary">

                        <i class="fa-solid fa-plus"></i>

                        Nuevo movimiento

                    </button>

                </div>

            </div>



            {{-- =================================================
                 ESTADO DE CAJA
            ================================================== --}}

            <div class="cash-status-panel">


                <div class="cash-status-left">


                    <div class="cash-status-icon">

                        <i class="fa-solid fa-cash-register"></i>

                    </div>


                    <div>

                        <span class="status-label">
                            ESTADO DE CAJA
                        </span>

                        <h3>
                            Caja abierta
                        </h3>

                        <p>
                            La caja se encuentra disponible para
                            registrar movimientos.
                        </p>

                    </div>

                </div>


                <div class="cash-status-details">


                    <div class="status-detail">

                        <span>
                            Responsable
                        </span>

                        <strong>
                            Administrador
                        </strong>

                    </div>


                    <div class="status-detail">

                        <span>
                            Apertura
                        </span>

                        <strong>
                            —
                        </strong>

                    </div>


                    <div class="status-detail">

                        <span>
                            Último movimiento
                        </span>

                        <strong>
                            —
                        </strong>

                    </div>


                </div>


                <button class="btn-close-cash">

                    <i class="fa-solid fa-lock"></i>

                    Cerrar caja

                </button>

            </div>



            {{-- =================================================
                 RESUMEN
            ================================================== --}}

            <div class="financial-summary">


                {{-- SALDO INICIAL --}}

                <div class="financial-card opening">

                    <div class="financial-card-top">

                        <div class="financial-icon">

                            <i class="fa-solid fa-wallet"></i>

                        </div>

                        <span class="financial-label">
                            Saldo inicial
                        </span>

                    </div>

                    <strong class="financial-value">
                        S/ 0.00
                    </strong>

                    <span class="financial-description">
                        Monto registrado al abrir caja
                    </span>

                </div>



                {{-- INGRESOS --}}

                <div class="financial-card income">

                    <div class="financial-card-top">

                        <div class="financial-icon">

                            <i class="fa-solid fa-arrow-trend-up"></i>

                        </div>

                        <span class="financial-label">
                            Ingresos
                        </span>

                    </div>

                    <strong class="financial-value">
                        S/ 0.00
                    </strong>

                    <span class="financial-description">
                        Total de ingresos del día
                    </span>

                </div>



                {{-- EGRESOS --}}

                <div class="financial-card expense">

                    <div class="financial-card-top">

                        <div class="financial-icon">

                            <i class="fa-solid fa-arrow-trend-down"></i>

                        </div>

                        <span class="financial-label">
                            Egresos
                        </span>

                    </div>

                    <strong class="financial-value">
                        S/ 0.00
                    </strong>

                    <span class="financial-description">
                        Total de egresos del día
                    </span>

                </div>



                {{-- SALDO ACTUAL --}}

                <div class="financial-card balance">

                    <div class="financial-card-top">

                        <div class="financial-icon">

                            <i class="fa-solid fa-coins"></i>

                        </div>

                        <span class="financial-label">
                            Saldo actual
                        </span>

                    </div>

                    <strong class="financial-value">
                        S/ 0.00
                    </strong>

                    <span class="financial-description">
                        Saldo disponible en caja
                    </span>

                </div>

            </div>



            {{-- =================================================
                 ACCIONES RÁPIDAS
            ================================================== --}}

            <div class="quick-actions-section">


                <div class="section-heading">

                    <div>

                        <h3>
                            Operaciones de caja
                        </h3>

                        <p>
                            Registra las operaciones financieras
                            realizadas durante la jornada.
                        </p>

                    </div>

                </div>


                <div class="quick-actions-grid">


                    <button class="quick-action income-action">

                        <span class="quick-action-icon">

                            <i class="fa-solid fa-arrow-down"></i>

                        </span>

                        <span class="quick-action-text">

                            <strong>
                                Registrar ingreso
                            </strong>

                            <small>
                                Registrar dinero recibido
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>



                    <button class="quick-action expense-action">

                        <span class="quick-action-icon">

                            <i class="fa-solid fa-arrow-up"></i>

                        </span>

                        <span class="quick-action-text">

                            <strong>
                                Registrar egreso
                            </strong>

                            <small>
                                Registrar dinero retirado
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>



                    <button class="quick-action payment-action">

                        <span class="quick-action-icon">

                            <i class="fa-solid fa-credit-card"></i>

                        </span>

                        <span class="quick-action-text">

                            <strong>
                                Registrar pago
                            </strong>

                            <small>
                                Asociar pago a una reserva
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-right"></i>

                    </button>

                </div>

            </div>



            {{-- =================================================
                 MOVIMIENTOS
            ================================================== --}}

            <div class="movements-panel">


                <div class="panel-header">


                    <div>

                        <h3>
                            Movimientos de caja
                        </h3>

                        <p>
                            Consulta las operaciones registradas.
                        </p>

                    </div>


                    <button class="btn-filter">

                        <i class="fa-solid fa-filter"></i>

                        Filtros

                    </button>

                </div>



                {{-- FILTROS --}}

                <div class="movements-filters">


                    <div class="search-box">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            placeholder="Buscar movimiento..."
                        >

                    </div>


                    <select>

                        <option value="">
                            Todos los movimientos
                        </option>

                        <option value="income">
                            Ingresos
                        </option>

                        <option value="expense">
                            Egresos
                        </option>

                        <option value="payment">
                            Pagos
                        </option>

                    </select>


                    <select>

                        <option value="">
                            Todos los métodos
                        </option>

                        <option value="cash">
                            Efectivo
                        </option>

                        <option value="card">
                            Tarjeta
                        </option>

                        <option value="transfer">
                            Transferencia
                        </option>

                    </select>


                    <input
                        type="date"
                        aria-label="Fecha"
                    >

                </div>



                {{-- TABLA --}}

                <div class="table-container">

                    <table class="movements-table">

                        <thead>

                            <tr>

                                <th>
                                    Hora
                                </th>

                                <th>
                                    Concepto
                                </th>

                                <th>
                                    Tipo
                                </th>

                                <th>
                                    Método
                                </th>

                                <th>
                                    Monto
                                </th>

                                <th>
                                    Responsable
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Acción
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            {{-- =================================================
                                 AQUÍ POSTERIORMENTE IRÁ:

                                 @foreach($movimientos as $movimiento)

                                 La tabla está preparada para conectar
                                 directamente con Laravel.
                            ================================================== --}}

                            <tr class="empty-row">

                                <td colspan="8">

                                    <div class="empty-state">

                                        <div class="empty-icon">

                                            <i class="fa-solid fa-receipt"></i>

                                        </div>

                                        <strong>
                                            No hay movimientos registrados
                                        </strong>

                                        <span>
                                            Los movimientos de caja aparecerán
                                            aquí cuando sean registrados.
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>



            {{-- =================================================
                 RESUMEN DE CIERRE
            ================================================== --}}

            <div class="closing-panel">


                <div class="closing-header">

                    <div>

                        <span class="page-kicker">
                            CONTROL DE CIERRE
                        </span>

                        <h3>
                            Resumen de cierre de caja
                        </h3>

                        <p>
                            Información que se utilizará posteriormente
                            para realizar el cierre de la jornada.
                        </p>

                    </div>

                    <div class="closing-icon">

                        <i class="fa-solid fa-lock"></i>

                    </div>

                </div>



                <div class="closing-summary">


                    <div class="closing-item">

                        <span>
                            Saldo inicial
                        </span>

                        <strong>
                            S/ 0.00
                        </strong>

                    </div>


                    <div class="closing-item">

                        <span>
                            Total ingresos
                        </span>

                        <strong>
                            S/ 0.00
                        </strong>

                    </div>


                    <div class="closing-item">

                        <span>
                            Total egresos
                        </span>

                        <strong>
                            S/ 0.00
                        </strong>

                    </div>


                    <div class="closing-item highlight">

                        <span>
                            Efectivo esperado
                        </span>

                        <strong>
                            S/ 0.00
                        </strong>

                    </div>


                    <div class="closing-item">

                        <span>
                            Efectivo contado
                        </span>

                        <strong>
                            S/ 0.00
                        </strong>

                    </div>


                    <div class="closing-item difference">

                        <span>
                            Diferencia
                        </span>

                        <strong>
                            S/ 0.00
                        </strong>

                    </div>

                </div>


                <div class="closing-observation">

                    <label for="observaciones">
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        placeholder="Ingrese observaciones del cierre..."
                    ></textarea>

                </div>


                <div class="closing-actions">

                    <button class="btn btn-outline">

                        Cancelar

                    </button>

                    <button class="btn btn-primary">

                        <i class="fa-solid fa-lock"></i>

                        Realizar cierre

                    </button>

                </div>

            </div>


        </section>

    </main>

</div>

</body>

</html>