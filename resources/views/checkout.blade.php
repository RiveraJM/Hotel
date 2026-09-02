{{-- =========================================================
     CHECK-OUT
     resources/views/checkout.blade.php
========================================================= --}}

<x-app-layout>

@vite(['resources/css/checkout.css'])


    {{-- =====================================================
         BARRA LATERAL
    ====================================================== --}}

    @if (false)
    <aside class="hotel-sidebar">


        {{-- MARCA --}}
        <div class="sidebar-brand">

            <div class="brand-logo">
                HM
            </div>

            <div class="brand-information">

                <strong>
                    Hotel Management
                </strong>

                <span>
                    Sistema de gestión
                </span>

            </div>

        </div>


        {{-- USUARIO --}}
        <div class="sidebar-user">

            <div class="user-avatar">
                --
            </div>

            <div class="user-information">

                <strong>
                    Usuario
                </strong>

                <span>
                    Administrador
                </span>

            </div>

        </div>


        {{-- NAVEGACIÓN --}}
        <nav class="sidebar-navigation">


            <div class="navigation-title">
                PRINCIPAL
            </div>


            <a href="#" class="navigation-item">

                <span class="navigation-icon">
                    🏠
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            <a href="#" class="navigation-item">

                <span class="navigation-icon">
                    🛏️
                </span>

                <span>
                    Habitaciones
                </span>

            </a>


            <a href="#" class="navigation-item">

                <span class="navigation-icon">
                    👤
                </span>

                <span>
                    Huéspedes
                </span>

            </a>


            <a href="#" class="navigation-item">

                <span class="navigation-icon">
                    📅
                </span>

                <span>
                    Reservas
                </span>

            </a>


            <div class="navigation-title">
                OPERACIONES
            </div>


            <a href="#" class="navigation-item">

                <span class="navigation-icon">
                    🛎️
                </span>

                <span>
                    Check-in
                </span>

            </a>


            {{-- ACTIVO --}}
            <a href="#" class="navigation-item active">

                <span class="navigation-icon">
                    🚪
                </span>

                <span>
                    Check-out
                </span>

            </a>


            <a href="#" class="navigation-item">

                <span class="navigation-icon">
                    💰
                </span>

                <span>
                    Pagos / Ingresos
                </span>

            </a>


            <div class="navigation-title">
                ADMINISTRACIÓN
            </div>


            <a href="#" class="navigation-item">

                <span class="navigation-icon">
                    📊
                </span>

                <span>
                    Reportes
                </span>

            </a>


            <a href="#" class="navigation-item">

                <span class="navigation-icon">
                    ⚙️
                </span>

                <span>
                    Configuración
                </span>

            </a>

        </nav>


        {{-- CERRAR SESIÓN --}}
        <div class="sidebar-footer">

            <button class="logout-button">

                <span>
                    ⇥
                </span>

                Cerrar sesión

            </button>

        </div>

    </aside>
    @endif



    {{-- =====================================================
         CONTENIDO PRINCIPAL
    ====================================================== --}}

    <main class="hotel-main">


        {{-- =================================================
             ENCABEZADO
        ================================================== --}}

        <header class="hotel-header">

            <div>

                <span class="page-breadcrumb">
                    Operaciones / Check-out
                </span>

                <h1>
                    Check-out
                </h1>

                <p>
                    Gestiona la salida de los huéspedes,
                    revisa sus consumos y finaliza su estadía.
                </p>

            </div>


            <div class="header-date">

                <span>
                    Fecha actual
                </span>

                <strong>
                    --
                </strong>

            </div>

        </header>



        {{-- =================================================
             BUSCAR ESTADÍA
        ================================================== --}}

        <section class="checkout-search-panel">


            <div class="section-heading">

                <div class="section-icon">
                    🔎
                </div>

                <div>

                    <h2>
                        Buscar estadía
                    </h2>

                    <p>
                        Busca al huésped por documento,
                        nombre, habitación o código de reserva.
                    </p>

                </div>

            </div>


            <div class="checkout-search-form">


                <div class="search-field">

                    <label>
                        Buscar por
                    </label>

                    <select>

                        <option value="">
                            Seleccionar
                        </option>

                        <option value="documento">
                            Documento
                        </option>

                        <option value="nombre">
                            Nombre del huésped
                        </option>

                        <option value="habitacion">
                            Habitación
                        </option>

                        <option value="reserva">
                            Código de reserva
                        </option>

                    </select>

                </div>


                <div class="search-field">

                    <label>
                        Información de búsqueda
                    </label>

                    <input
                        type="text"
                        placeholder="Ingrese el dato a buscar"
                    >

                </div>


                <button
                    type="button"
                    class="primary-button"
                >

                    🔎

                    Buscar estadía

                </button>

            </div>

        </section>



        {{-- =================================================
             RESULTADO
             
             Esta sección posteriormente se mostrará
             solamente cuando exista una estadía activa.
        ================================================== --}}

        <section class="checkout-result">


            <div class="result-header">

                <div>

                    <span class="card-label">
                        ESTADÍA ACTIVA
                    </span>

                    <h2>
                        Información de la estadía
                    </h2>

                </div>


                <span class="stay-status">
                    ESTADÍA ACTIVA
                </span>

            </div>



            {{-- =================================================
                 INFORMACIÓN PRINCIPAL
            ================================================== --}}

            <div class="stay-information">


                <div class="guest-main">

                    <div class="guest-avatar">
                        --
                    </div>

                    <div>

                        <span>
                            Huésped
                        </span>

                        <strong>
                            --
                        </strong>

                        <small>
                            Documento: --
                        </small>

                    </div>

                </div>


                <div class="stay-data">

                    <div>

                        <span>
                            Reserva
                        </span>

                        <strong>
                            --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Habitación
                        </span>

                        <strong>
                            --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Check-in
                        </span>

                        <strong>
                            --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Check-out previsto
                        </span>

                        <strong>
                            --
                        </strong>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 RESUMEN DE CONSUMOS
            ================================================== --}}

            <div class="consumption-section">


                <div class="section-title">

                    <div>

                        <span class="card-label">
                            CONSUMOS
                        </span>

                        <h3>
                            Consumos adicionales
                        </h3>

                    </div>


                    <button
                        type="button"
                        class="secondary-button"
                    >

                        + Agregar consumo

                    </button>

                </div>



                <div class="consumption-table-wrapper">

                    <table class="consumption-table">

                        <thead>

                            <tr>

                                <th>
                                    Concepto
                                </th>

                                <th>
                                    Cantidad
                                </th>

                                <th>
                                    Precio
                                </th>

                                <th>
                                    Subtotal
                                </th>

                                <th>
                                    Acción
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            {{--

                            Aquí posteriormente:

                            @foreach($consumos as $consumo)

                            <tr>
                                ...
                            </tr>

                            @endforeach

                            --}}

                            <tr class="empty-row">

                                <td colspan="5">

                                    No hay consumos registrados.

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>



            {{-- =================================================
                 RESUMEN DE PAGO
            ================================================== --}}

            <div class="payment-summary">


                <div class="payment-summary-title">

                    <span class="card-label">
                        RESUMEN DE CUENTA
                    </span>

                    <h3>
                        Total de la estadía
                    </h3>

                </div>


                <div class="payment-lines">


                    <div>

                        <span>
                            Alojamiento
                        </span>

                        <strong>
                            S/ --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Consumos
                        </span>

                        <strong>
                            S/ --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Descuentos
                        </span>

                        <strong class="discount-amount">
                            - S/ --
                        </strong>

                    </div>


                    <div class="total-line">

                        <span>
                            Total
                        </span>

                        <strong>
                            S/ --
                        </strong>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 PAGO
            ================================================== --}}

            <div class="checkout-payment">


                <div class="payment-method">

                    <label>
                        Método de pago
                    </label>

                    <select>

                        <option value="">
                            Seleccionar método de pago
                        </option>

                        <option value="efectivo">
                            Efectivo
                        </option>

                        <option value="tarjeta">
                            Tarjeta
                        </option>

                        <option value="yape">
                            Yape
                        </option>

                        <option value="plin">
                            Plin
                        </option>

                        <option value="transferencia">
                            Transferencia bancaria
                        </option>

                    </select>

                </div>


                <div class="payment-status">

                    <span>
                        Estado de pago
                    </span>

                    <strong>
                        Pendiente
                    </strong>

                </div>

            </div>



            {{-- =================================================
                 OBSERVACIONES
            ================================================== --}}

            <div class="checkout-observations">

                <label>
                    Observaciones de salida
                </label>

                <textarea
                    placeholder="Ingrese observaciones relacionadas con la salida del huésped..."
                ></textarea>

            </div>



            {{-- =================================================
                 ACCIONES
            ================================================== --}}

            <div class="checkout-actions">


                <button
                    type="button"
                    class="cancel-button"
                >

                    Cancelar

                </button>


                <button
                    type="button"
                    class="receipt-button"
                >

                    🧾

                    Generar comprobante

                </button>


                <button
                    type="button"
                    class="checkout-button"
                >

                    ✓

                    Confirmar Check-out

                </button>

            </div>

        </section>



        {{-- =================================================
             ESTADO SIN RESULTADO
             
             Posteriormente se puede controlar con:
             
             @if(!$estadias)
                 ...
             @endif
        ================================================== --}}

        <section class="checkout-empty-state">


            <div class="empty-icon">
                🔎
            </div>


            <h2>
                Buscar una estadía activa
            </h2>


            <p>
                Utiliza el buscador superior para encontrar
                la estadía que deseas finalizar.
            </p>


        </section>


    </main>

</x-app-layout>