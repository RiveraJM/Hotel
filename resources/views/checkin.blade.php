<x-app-layout>

{{-- =========================================================
    CHECK-IN
========================================================= --}}

@vite(['resources/css/checkin.css'])

<div
    class="checkin-page"
    id="checkinPage"
    data-search-url="{{ route('checkin.search') }}"
    data-store-url="{{ route('checkin.store') }}"
>

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
                        ?
                    </div>


                    <div class="guest-main-info">

                        <h2 id="guestName">
                            Selecciona un huésped
                        </h2>

                        <span
                            class="guest-category"
                            id="guestCategory"
                        >
                            Sin consultar
                        </span>

                    </div>

                </div>


                <div class="guest-details-grid">

                    <div class="detail-item">

                        <span class="detail-label">
                            Documento
                        </span>

                        <strong id="guestDocument">
                            —
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Teléfono
                        </span>

                        <strong id="guestPhone">
                            —
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Correo electrónico
                        </span>

                        <strong id="guestEmail">
                            —
                        </strong>

                    </div>


                    <div class="detail-item">

                        <span class="detail-label">
                            Nacionalidad
                        </span>

                        <strong id="guestNationality">
                            No registrado
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
                            required
                        >

                            <option value="">Seleccione una habitación</option>
                            @foreach ($habitaciones as $habitacion)
                                <option
                                    value="{{ $habitacion->id }}"
                                    data-number="{{ $habitacion->numero }}"
                                    data-price="{{ $habitacion->precio }}"
                                >
                                    {{ $habitacion->numero }} — {{ $habitacion->tipo }} · S/ {{ number_format($habitacion->precio, 2) }}
                                </option>
                            @endforeach

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
                            placeholder="Se genera automáticamente si no existe"
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
                            value="{{ now()->format('Y-m-d') }}"
                            required
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
                            value="{{ now()->addDay()->format('Y-m-d') }}"
                            required
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
                        0
                    </div>

                    <div>

                        <strong>
                            estancias anteriores
                        </strong>

                        <span>
                            Consulta un huésped para ver su historial
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
                                —
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
                                0 reservas
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
                                Sin consultar
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
                    0%
                </div>


                <strong id="discountDescription">
                    Sin descuento asignado
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
                        —
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Estadía
                    </span>

                    <strong id="summaryNights">
                        0 noches
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Tarifa
                    </span>

                    <strong id="summaryRate">
                        S/ 0.00
                    </strong>

                </div>


                <div class="summary-row discount-row">

                    <span>
                        Descuento
                    </span>

                    <strong id="summaryDiscount">
                        - S/ 0.00
                    </strong>

                </div>


                <div class="summary-total">

                    <span>
                        Total
                    </span>

                    <strong id="summaryTotal">
                        S/ 0.00
                    </strong>

                </div>

            </section>

        </aside>

    </div>

</div>

<script>
    (() => {
        const page = document.getElementById('checkinPage');
        if (!page) return;

        const csrf = document.querySelector('#formBuscarHuesped input[name="_token"]').value;
        const state = { guest: null, reservation: null, newGuest: null, discountPercent: 0 };
        const roomSelect = document.getElementById('habitacion');
        const result = document.getElementById('resultadoBusqueda');
        const searchForm = document.getElementById('formBuscarHuesped');

        const showMessage = (message, type = 'success') => {
            result.textContent = message;
            result.className = `search-result-message ${type}`;
            result.hidden = false;
        };

        const setText = (id, value, fallback = 'No registrado') => {
            document.getElementById(id).textContent = value || fallback;
        };

        const updateSummary = () => {
            const option = roomSelect.selectedOptions[0];
            const start = new Date(`${document.getElementById('fechaEntrada').value}T00:00:00`);
            const end = new Date(`${document.getElementById('fechaSalida').value}T00:00:00`);
            const nights = Math.max(0, Math.round((end - start) / 86400000));
            const rate = Number(option?.dataset.price || 0) * nights;
            const discount = document.getElementById('aplicarDescuento').checked
                ? rate * (state.discountPercent / 100)
                : 0;

            setText('summaryRoom', option?.dataset.number || '—');
            setText('summaryNights', `${nights} ${nights === 1 ? 'noche' : 'noches'}`);
            setText('summaryRate', `S/ ${rate.toFixed(2)}`);
            setText('summaryDiscount', `- S/ ${discount.toFixed(2)}`);
            setText('summaryTotal', `S/ ${(rate - discount).toFixed(2)}`);
        };

        const fillGuest = (guest, category = 'Huésped registrado') => {
            state.guest = guest;
            state.newGuest = null;
            setText('guestName', guest.nombre);
            setText('guestCategory', category);
            setText('guestDocument', `${guest.tipo_documento} ${guest.numero_documento}`);
            setText('guestPhone', guest.telefono);
            setText('guestEmail', guest.email);
            document.getElementById('guestAvatar').textContent = guest.nombre.split(' ').slice(0, 2).map(word => word[0]).join('').toUpperCase();
        };

        searchForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const button = document.getElementById('btnBuscarHuesped');
            button.disabled = true;
            try {
                const response = await fetch(page.dataset.searchUrl, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                    body: new FormData(searchForm),
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'No se pudo realizar la búsqueda.');

                state.reservation = data.reserva;
                state.discountPercent = data.historial.descuento || 0;
                fillGuest(data.huesped, data.historial.categoria);
                document.getElementById('codigoReserva').value = data.reserva.codigo;
                document.getElementById('fechaEntrada').value = data.reserva.fecha_entrada;
                document.getElementById('fechaSalida').value = data.reserva.fecha_salida;
                document.getElementById('adultos').value = data.reserva.cantidad_huespedes;
                roomSelect.value = data.reserva.habitacion_id;
                setText('totalEstancias', data.historial.total);
                setText('ultimaEstancia', data.historial.ultima_estancia || 'Primera estancia');
                setText('totalReservas', `${data.historial.total + 1} reservas`);
                setText('categoriaHuesped', data.historial.categoria);
                setText('discountValue', `${state.discountPercent}%`);
                setText('discountDescription', state.discountPercent > 0 ? 'Descuento por historial de estancias' : 'Sin descuento asignado');
                document.getElementById('aplicarDescuento').checked = state.discountPercent > 0;
                showMessage(`Reserva ${data.reserva.codigo} lista para registrar.`, 'success');
                updateSummary();
            } catch (error) {
                showMessage(error.message, 'warning');
            } finally {
                button.disabled = false;
            }
        });

        document.getElementById('btnNuevoHuesped').addEventListener('click', () => {
            document.getElementById('newGuestPanel').hidden = false;
            document.getElementById('guestRegisteredPanel').hidden = true;
            document.getElementById('newGuestPanel').scrollIntoView({ behavior: 'smooth', block: 'center' });
        });

        document.getElementById('btnCancelarNuevoHuesped').addEventListener('click', () => {
            document.getElementById('newGuestPanel').hidden = true;
            document.getElementById('guestRegisteredPanel').hidden = false;
        });

        document.getElementById('formNuevoHuesped').addEventListener('submit', (event) => {
            event.preventDefault();
            const data = new FormData(event.currentTarget);
            state.guest = null;
            state.reservation = null;
            state.discountPercent = 0;
            state.newGuest = {
                tipo_documento: data.get('tipo_documento'),
                numero_documento: data.get('numero_documento'),
                nombre: `${data.get('nombres')} ${data.get('apellidos')}`.trim(),
                telefono: data.get('telefono'),
                email: data.get('email'),
            };
            fillGuest(state.newGuest, 'Primera estancia');
            setText('categoriaHuesped', 'Primera estancia');
            setText('discountValue', '0%');
            setText('discountDescription', 'Sin descuento asignado');
            document.getElementById('aplicarDescuento').checked = false;
            document.getElementById('newGuestPanel').hidden = true;
            document.getElementById('guestRegisteredPanel').hidden = false;
            showMessage('Huésped preparado. Completa la estadía y confirma el check-in.', 'success');
        });

        document.querySelectorAll('[data-action]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.target);
                const change = button.dataset.action === 'increase' ? 1 : -1;
                input.value = Math.max(Number(input.min), Number(input.value) + change);
            });
        });

        [roomSelect, document.getElementById('fechaEntrada'), document.getElementById('fechaSalida'), document.getElementById('aplicarDescuento')]
            .forEach(input => input.addEventListener('change', updateSummary));

        document.getElementById('btnConfirmarCheckin').addEventListener('click', async () => {
            const button = document.getElementById('btnConfirmarCheckin');
            const cantidad = Number(document.getElementById('adultos').value) + Number(document.getElementById('ninos').value);
            const payload = {
                reserva_id: state.reservation?.id,
                huesped_id: state.guest?.id,
                habitacion_id: roomSelect.value,
                fecha_entrada: document.getElementById('fechaEntrada').value,
                fecha_salida: document.getElementById('fechaSalida').value,
                cantidad_huespedes: cantidad,
                codigo_reserva: document.getElementById('codigoReserva').value,
                nuevo_huesped: state.newGuest,
            };

            if (!payload.huesped_id && !payload.nuevo_huesped) return showMessage('Busca un huésped o regístralo antes de confirmar.', 'warning');
            if (!payload.habitacion_id) return showMessage('Selecciona una habitación.', 'warning');
            button.disabled = true;
            try {
                const response = await fetch(page.dataset.storeUrl, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(payload),
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || Object.values(data.errors || {}).flat()[0] || 'No se pudo registrar el check-in.');
                showMessage(`${data.message} Habitación ${data.habitacion}, reserva ${data.codigo}.`, 'success');
                button.innerHTML = '<i class="fa-solid fa-circle-check"></i> Check-in registrado';
            } catch (error) {
                showMessage(error.message, 'warning');
                button.disabled = false;
            }
        });

        updateSummary();
    })();
</script>

</x-app-layout>