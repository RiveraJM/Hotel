<x-app-layout>

{{-- =========================================================
    CHECK-IN
========================================================= --}}

@vite(['resources/css/checkin.css'])

<div class="checkin-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <header class="checkin-header">

        <div class="checkin-title">

            <div class="checkin-title-icon">
                <i class="fa-solid fa-door-open"></i>
            </div>

            <div>
                <h1>Check-in</h1>

                <p>
                    Registra la llegada y prepara la estadía del huésped.
                </p>
            </div>

        </div>

        <button
            type="button"
            class="checkin-new-guest"
            id="btnNuevoHuesped"
        >
            <i class="fa-solid fa-user-plus"></i>
            Nuevo huésped
        </button>

    </header>


    {{-- =====================================================
         PASOS
    ====================================================== --}}
    <div class="checkin-progress">

        <div class="progress-step active" data-step="1">

            <span class="progress-number">01</span>

            <div>
                <strong>Huésped</strong>
                <span>Identificación</span>
            </div>

        </div>

        <div class="progress-line"></div>

        <div class="progress-step" data-step="2">

            <span class="progress-number">02</span>

            <div>
                <strong>Historial</strong>
                <span>Verificación</span>
            </div>

        </div>

        <div class="progress-line"></div>

        <div class="progress-step" data-step="3">

            <span class="progress-number">03</span>

            <div>
                <strong>Estadía</strong>
                <span>Habitación</span>
            </div>

        </div>

        <div class="progress-line"></div>

        <div class="progress-step" data-step="4">

            <span class="progress-number">04</span>

            <div>
                <strong>Confirmación</strong>
                <span>Finalizar</span>
            </div>

        </div>

    </div>


    {{-- =====================================================
         BUSCAR HUÉSPED
    ====================================================== --}}
    <section class="guest-search-panel">

        <div class="section-heading">

            <span class="section-kicker">
                IDENTIFICACIÓN DEL HUÉSPED
            </span>

            <h2>Buscar huésped</h2>

            <p>
                Busca por DNI, pasaporte, nombre, teléfono o código de reserva.
            </p>

        </div>


        <form
            id="formBuscarHuesped"
            class="guest-search"
        >

            @csrf

            <div class="search-input-wrapper">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="buscarHuesped"
                    name="buscar"
                    placeholder="Ingrese DNI, pasaporte, nombre, teléfono o código..."
                    autocomplete="off"
                >

            </div>

            <button
                type="submit"
                class="search-button"
                id="btnBuscarHuesped"
            >
                <i class="fa-solid fa-magnifying-glass"></i>
                Buscar
            </button>

        </form>


        {{-- Mensaje de resultado --}}
        <div
            id="resultadoBusqueda"
            class="search-result-message"
            hidden
        ></div>

    </section>


    {{-- =====================================================
         CONTENIDO
    ====================================================== --}}
    <div class="checkin-content">


        {{-- =================================================
             COLUMNA PRINCIPAL
        ================================================== --}}
        <main class="checkin-main-column">


            {{-- =================================================
                 HUÉSPED REGISTRADO
            ================================================== --}}
            <section
                class="checkin-card guest-card"
                id="guestRegisteredPanel"
            >

                <div class="card-header">

                    <div class="card-header-title">

                        <span class="card-icon blue">
                            <i class="fa-solid fa-user"></i>
                        </span>

                        <div>
                            <h3>Datos del huésped</h3>

                            <p>
                                Información registrada del cliente.
                            </p>
                        </div>

                    </div>

                    <span class="guest-identified">

                        <i class="fa-solid fa-circle-check"></i>

                        Registrado

                    </span>

                </div>


                <div class="guest-profile">

                    <div
                        class="guest-avatar"
                        id="guestAvatar"
                    >
                        JP
                    </div>


                    <div class="guest-main-info">

                        <h2 id="guestName">
                            Juan Pérez
                        </h2>

                        <span
                            class="guest-category"
                            id="guestCategory"
                        >
                            Huésped frecuente
                        </span>

                    </div>

                </div>


                <div class="guest-details-grid">

                    <div class="detail-item">

                        <span class="detail-label">
                            Documento
                        </span>

                        <strong id="guestDocument">
                            DNI 74851236
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Teléfono
                        </span>

                        <strong id="guestPhone">
                            987 654 321
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Correo electrónico
                        </span>

                        <strong id="guestEmail">
                            juan.perez@email.com
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Nacionalidad
                        </span>

                        <strong id="guestNationality">
                            Peruana
                        </strong>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 HUÉSPED NO REGISTRADO
            ================================================== --}}
            <section
                class="checkin-card new-guest-card"
                id="newGuestPanel"
                hidden
            >

                <div class="card-header">

                    <div class="card-header-title">

                        <span class="card-icon blue">
                            <i class="fa-solid fa-user-plus"></i>
                        </span>

                        <div>

                            <h3>Registrar huésped</h3>

                            <p>
                                Complete únicamente los datos necesarios.
                            </p>

                        </div>

                    </div>

                    <span class="new-guest-status">
                        Nuevo huésped
                    </span>

                </div>


                <form id="formNuevoHuesped">

                    @csrf

                    <div class="new-guest-grid">

                        <div class="form-group">

                            <label for="tipoDocumento">
                                Tipo de documento *
                            </label>

                            <select
                                id="tipoDocumento"
                                name="tipo_documento"
                                required
                            >
                                <option value="DNI">DNI</option>
                                <option value="PASAPORTE">Pasaporte</option>
                                <option value="CE">Carné de extranjería</option>
                            </select>

                        </div>


                        <div class="form-group">

                            <label for="numeroDocumento">
                                Número de documento *
                            </label>

                            <input
                                type="text"
                                id="numeroDocumento"
                                name="numero_documento"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="nombres">
                                Nombres *
                            </label>

                            <input
                                type="text"
                                id="nombres"
                                name="nombres"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="apellidos">
                                Apellidos *
                            </label>

                            <input
                                type="text"
                                id="apellidos"
                                name="apellidos"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="telefono">
                                Teléfono
                            </label>

                            <input
                                type="text"
                                id="telefono"
                                name="telefono"
                            >

                        </div>


                        <div class="form-group">

                            <label for="email">
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                            >

                        </div>

                    </div>


                    <div class="new-guest-actions">

                        <button
                            type="button"
                            class="secondary-button"
                            id="btnCancelarNuevoHuesped"
                        >
                            Cancelar
                        </button>

                        <button
                            type="submit"
                            class="primary-button"
                        >
                            <i class="fa-solid fa-user-check"></i>
                            Registrar y continuar
                        </button>

                    </div>

                </form>

            </section>


            {{-- =================================================
                 INFORMACIÓN DE ESTADÍA
            ================================================== --}}
            <section
                class="checkin-card"
                id="stayPanel"
            >

                <div class="card-header">

                    <div class="card-header-title">

                        <span class="card-icon gold">
                            <i class="fa-solid fa-bed"></i>
                        </span>

                        <div>

                            <h3>Información de estadía</h3>

                            <p>
                                Datos de la reserva y alojamiento.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="stay-grid">


                    <div class="form-group">

                        <label for="habitacion">
                            Habitación *
                        </label>

                        <select
                            id="habitacion"
                            name="habitacion_id"
                        >

                            <option value="204">
                                204 — Matrimonial
                            </option>

                            <option value="108">
                                108 — Matrimonial
                            </option>

                            <option value="301">
                                301 — Suite
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="codigoReserva">
                            Código de reserva
                        </label>

                        <input
                            type="text"
                            id="codigoReserva"
                            name="codigo_reserva"
                            value="#RS-001"
                        >

                    </div>


                    <div class="form-group">

                        <label for="fechaEntrada">
                            Fecha de entrada *
                        </label>

                        <input
                            type="date"
                            id="fechaEntrada"
                            name="fecha_entrada"
                            value="2026-08-26"
                        >

                    </div>


                    <div class="form-group">

                        <label for="fechaSalida">
                            Fecha de salida *
                        </label>

                        <input
                            type="date"
                            id="fechaSalida"
                            name="fecha_salida"
                            value="2026-08-29"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Adultos
                        </label>

                        <div class="number-input">

                            <button
                                type="button"
                                data-action="decrease"
                                data-target="adultos"
                            >
                                −
                            </button>

                            <input
                                type="number"
                                id="adultos"
                                name="adultos"
                                value="2"
                                min="1"
                            >

                            <button
                                type="button"
                                data-action="increase"
                                data-target="adultos"
                            >
                                +
                            </button>

                        </div>

                    </div>


                    <div class="form-group">

                        <label>
                            Niños
                        </label>

                        <div class="number-input">

                            <button
                                type="button"
                                data-action="decrease"
                                data-target="ninos"
                            >
                                −
                            </button>

                            <input
                                type="number"
                                id="ninos"
                                name="ninos"
                                value="0"
                                min="0"
                            >

                            <button
                                type="button"
                                data-action="increase"
                                data-target="ninos"
                            >
                                +
                            </button>

                        </div>

                    </div>

                </div>


                <div class="form-group full-width">

                    <label for="observaciones">
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        placeholder="Observaciones del huésped..."
                    ></textarea>

                </div>

            </section>


            {{-- =================================================
                 CONFIRMACIÓN
            ================================================== --}}
            <section class="checkin-confirmation">

                <div class="confirmation-icon">

                    <i class="fa-solid fa-check"></i>

                </div>


                <div class="confirmation-content">

                    <strong>
                        Listo para registrar el ingreso
                    </strong>

                    <span>
                        Verifique la información antes de confirmar.
                    </span>

                </div>


                <button
                    type="button"
                    class="confirm-checkin"
                    id="btnConfirmarCheckin"
                >

                    <i class="fa-solid fa-check"></i>

                    Confirmar Check-in

                </button>

            </section>

        </main>


        {{-- =================================================
             SIDEBAR
        ================================================== --}}
        <aside class="checkin-sidebar">


            {{-- =================================================
                 HISTORIAL
            ================================================== --}}
            <section
                class="checkin-card history-card"
                id="historyPanel"
            >

                <div class="card-header">

                    <div class="card-header-title">

                        <span class="card-icon purple">

                            <i class="fa-solid fa-clock-rotate-left"></i>

                        </span>

                        <div>

                            <h3>Historial</h3>

                            <p>
                                Historial del huésped.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="history-summary">

                    <div
                        class="history-number"
                        id="totalEstancias"
                    >
                        12
                    </div>

                    <div>

                        <strong>
                            estancias anteriores
                        </strong>

                        <span>
                            Cliente recurrente
                        </span>

                    </div>

                </div>


                <div class="history-list">

                    <div class="history-item">

                        <div class="history-icon">
                            <i class="fa-solid fa-hotel"></i>
                        </div>

                        <div>

                            <strong>
                                Última estancia
                            </strong>

                            <span id="ultimaEstancia">
                                15 Jun. 2026
                            </span>

                        </div>

                    </div>


                    <div class="history-item">

                        <div class="history-icon">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>

                        <div>

                            <strong>
                                Reservas realizadas
                            </strong>

                            <span id="totalReservas">
                                14 reservas
                            </span>

                        </div>

                    </div>


                    <div class="history-item">

                        <div class="history-icon">
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <div>

                            <strong>
                                Categoría
                            </strong>

                            <span id="categoriaHuesped">
                                Huésped frecuente
                            </span>

                        </div>

                    </div>

                </div>


                <button
                    type="button"
                    class="history-button"
                    id="btnVerHistorial"
                >
                    Ver historial completo

                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </section>


            {{-- =================================================
                 DESCUENTO
            ================================================== --}}
            <section
                class="discount-card"
                id="discountPanel"
            >

                <div class="discount-header">

                    <div class="discount-icon">
                        <i class="fa-solid fa-tag"></i>
                    </div>

                    <span>
                        BENEFICIO DISPONIBLE
                    </span>

                </div>


                <div
                    class="discount-value"
                    id="discountValue"
                >
                    10%
                </div>


                <strong id="discountDescription">
                    Descuento por huésped frecuente
                </strong>


                <p>
                    Beneficio disponible según el historial
                    y categoría del huésped.
                </p>


                <div class="discount-action">

                    <label class="discount-switch">

                        <input
                            type="checkbox"
                            id="aplicarDescuento"
                            checked
                        >

                        <span class="switch-slider"></span>

                    </label>

                    <span>
                        Aplicar descuento
                    </span>

                </div>

            </section>


            {{-- =================================================
                 RESUMEN
            ================================================== --}}
            <section
                class="checkin-card summary-card"
                id="summaryPanel"
            >

                <div class="card-header">

                    <div class="card-header-title">

                        <span class="card-icon green">

                            <i class="fa-solid fa-receipt"></i>

                        </span>

                        <div>

                            <h3>Resumen</h3>

                            <p>
                                Resumen de estadía.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="summary-row">

                    <span>
                        Habitación
                    </span>

                    <strong id="summaryRoom">
                        204
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Estadía
                    </span>

                    <strong id="summaryNights">
                        3 noches
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Tarifa
                    </span>

                    <strong id="summaryRate">
                        S/ 450.00
                    </strong>

                </div>


                <div class="summary-row discount-row">

                    <span>
                        Descuento
                    </span>

                    <strong id="summaryDiscount">
                        - S/ 45.00
                    </strong>

                </div>


                <div class="summary-total">

                    <span>
                        Total
                    </span>

                    <strong id="summaryTotal">
                        S/ 405.00
                    </strong>

                </div>

            </section>

        </aside>

    </div>

</div>

</x-app-layout>