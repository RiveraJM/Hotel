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

    <main
        class="hotel-main"
        id="checkoutPage"
        data-search-url="{{ route('checkout.search') }}"
    >


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

                    <strong id="currentDate">
                        {{ now()->format('d/m/Y') }}
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

                    <select id="searchField">

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
                        id="searchValue"
                        type="text"
                        placeholder="Ingrese el dato a buscar"
                    >

                </div>


                <button
                    type="button"
                    class="primary-button"
                    id="btnSearchCheckout"
                >

                    🔎

                    Buscar estadía

                </button>

            </div>

            <div class="occupied-stays" aria-live="polite">
                <div class="occupied-stays-heading">
                    <strong>Habitaciones ocupadas</strong>
                    <span>{{ $habitacionesOcupadas->count() }} ocupadas</span>
                </div>
                <div class="occupied-stays-list">
                    @forelse ($habitacionesOcupadas as $ocupada)
                        @php($estadia = $ocupada->reservas->first())
                        @if ($estadia)
                            <button type="button" class="occupied-stay" data-occupied-stay="{{ $estadia->codigo }}">
                                <strong>Hab. {{ $ocupada->numero }}</strong>
                                <span>{{ $estadia->huesped?->nombre ?? 'Huésped sin datos' }} · {{ $estadia->codigo }}</span>
                            </button>
                        @else
                            <span class="occupied-stay occupied-stay-warning">
                                <strong>Hab. {{ $ocupada->numero }}</strong>
                                <span>Sin reserva activa · revisar</span>
                            </span>
                        @endif
                    @empty
                        <span class="occupied-stays-empty">No hay habitaciones ocupadas para cerrar.</span>
                    @endforelse
                </div>
            </div>

        </section>



        {{-- =================================================
             RESULTADO
             
             Esta sección posteriormente se mostrará
             solamente cuando exista una estadía activa.
        ================================================== --}}

        <section class="checkout-result" id="checkoutResult" hidden>


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

                    <div class="guest-avatar" id="checkoutAvatar">
                        --
                    </div>

                    <div>

                        <span>
                            Huésped
                        </span>

                        <strong id="checkoutGuest">
                            --
                        </strong>

                        <small id="checkoutDocument">
                            Documento: --
                        </small>

                    </div>

                </div>


                <div class="stay-data">

                    <div>

                        <span>
                            Reserva
                        </span>

                        <strong id="checkoutReservation">
                            --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Habitación
                        </span>

                        <strong id="checkoutRoom">
                            --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Check-in
                        </span>

                        <strong id="checkoutCheckin">
                            --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Check-out previsto
                        </span>

                        <strong id="checkoutExpected">
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
                        id="btnAddConsumption"
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


                        <tbody id="consumptionBody">

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

                        <strong id="accommodationTotal">
                            S/ --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Consumos
                        </span>

                        <strong id="consumptionsTotal">
                            S/ --
                        </strong>

                    </div>


                    <div>

                        <span>
                            Descuentos
                        </span>

                        <strong class="discount-amount" id="discountTotal">
                            - S/ --
                        </strong>

                    </div>


                    <div class="total-line">

                        <span>
                            Total
                        </span>

                        <strong id="checkoutTotal">
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

                    <select id="paymentMethod">

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

                    <strong id="paymentStatus">
                        Pendiente
                    </strong>

                </div>

                <div class="payment-method">
                    <label for="receiptType">Comprobante</label>
                    <select id="receiptType">
                        <option value="ticket">Ticket de venta</option>
                        <option value="boleta">Boleta</option>
                    </select>
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
                    id="checkoutObservations"
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
                    id="btnConfirmCheckout"
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

        <section class="checkout-empty-state" id="checkoutEmptyState">


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

    <section class="receipt-modal" id="receiptModal" hidden aria-hidden="true">
        <div class="receipt-modal-actions no-print">
            <button type="button" class="receipt-close" id="closeReceipt">Cerrar</button>
            <button type="button" class="receipt-print" id="printReceipt"><i class="fa-solid fa-print"></i> Imprimir comprobante</button>
        </div>
        <article class="receipt-paper" id="receiptPaper">
            <div class="receipt-brand">HOTEL CIELO</div>
            <p class="receipt-title" id="receiptTitle">TICKET DE VENTA</p>
            <p class="receipt-number" id="receiptNumber"></p>
            <div class="receipt-divider"></div>
            <div class="receipt-data"><span>Fecha</span><strong id="receiptDate"></strong></div>
            <div class="receipt-data"><span>Reserva</span><strong id="receiptReservation"></strong></div>
            <div class="receipt-data"><span>Huésped</span><strong id="receiptGuest"></strong></div>
            <div class="receipt-data"><span>Documento</span><strong id="receiptDocument"></strong></div>
            <div class="receipt-data"><span>Habitación</span><strong id="receiptRoom"></strong></div>
            <div class="receipt-divider"></div>
            <div id="receiptLines"></div>
            <div class="receipt-total"><span>TOTAL</span><strong id="receiptTotal"></strong></div>
            <div class="receipt-data"><span>Método de pago</span><strong id="receiptMethod"></strong></div>
            <p class="receipt-thanks">Gracias por su preferencia.</p>
        </article>
    </section>

    <script>
        (() => {
            const page = document.getElementById('checkoutPage');
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
            const state = { stay: null, consumptions: [] };
            const receiptModal = document.getElementById('receiptModal');
            const money = value => `S/ ${Number(value || 0).toFixed(2)}`;
            const showReceipt = receipt => {
                document.getElementById('receiptTitle').textContent = receipt.type === 'boleta' ? 'BOLETA DE VENTA' : 'TICKET DE VENTA';
                document.getElementById('receiptNumber').textContent = receipt.number;
                document.getElementById('receiptDate').textContent = receipt.checkout;
                document.getElementById('receiptReservation').textContent = receipt.reservation;
                document.getElementById('receiptGuest').textContent = receipt.guest;
                document.getElementById('receiptDocument').textContent = receipt.document;
                document.getElementById('receiptRoom').textContent = receipt.room;
                document.getElementById('receiptTotal').textContent = money(receipt.total);
                document.getElementById('receiptMethod').textContent = receipt.payment_method;
                const lines = [{ concept: 'Alojamiento', quantity: 1, price: receipt.accommodation }, ...(receipt.consumptions || [])];
                document.getElementById('receiptLines').innerHTML = lines.map(line => `<div class="receipt-line"><span>${line.quantity} x ${line.concept}</span><strong>${money(line.quantity * line.price)}</strong></div>`).join('');
                receiptModal.hidden = false;
                receiptModal.setAttribute('aria-hidden', 'false');
            };
            const setText = (id, value) => document.getElementById(id).textContent = value || '--';
            const message = text => window.alert(text);

            const renderConsumption = () => {
                const body = document.getElementById('consumptionBody');
                body.innerHTML = '';
                if (!state.consumptions.length) {
                    body.innerHTML = '<tr class="empty-row"><td colspan="5">No hay consumos registrados.</td></tr>';
                } else {
                    state.consumptions.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>${item.concept}</td><td>${item.quantity}</td><td>${money(item.price)}</td><td>${money(item.quantity * item.price)}</td><td><button type="button" data-remove="${index}" aria-label="Eliminar consumo">Eliminar</button></td>`;
                        body.appendChild(row);
                    });
                }
                const total = state.consumptions.reduce((sum, item) => sum + item.quantity * item.price, 0);
                setText('consumptionsTotal', money(total));
                setText('checkoutTotal', money((state.stay?.accommodation || 0) + total - (state.stay?.discount || 0)));
                body.querySelectorAll('[data-remove]').forEach(button => button.addEventListener('click', () => {
                    state.consumptions.splice(Number(button.dataset.remove), 1);
                    renderConsumption();
                }));
            };

            const renderStay = stay => {
                state.stay = stay;
                setText('checkoutGuest', stay.guest.name);
                setText('checkoutDocument', `Documento: ${stay.guest.document}`);
                setText('checkoutAvatar', stay.guest.name.split(' ').slice(0, 2).map(word => word[0]).join('').toUpperCase());
                setText('checkoutReservation', stay.reservation);
                setText('checkoutRoom', stay.room);
                setText('checkoutCheckin', stay.checkin);
                setText('checkoutExpected', stay.checkout);
                setText('accommodationTotal', money(stay.accommodation));
                setText('discountTotal', `- ${money(stay.discount)}`);
                document.getElementById('checkoutResult').hidden = false;
                document.getElementById('checkoutEmptyState').hidden = true;
                state.consumptions = stay.consumptions || [];
                renderConsumption();
            };

            document.getElementById('btnSearchCheckout').addEventListener('click', async () => {
                const term = document.getElementById('searchValue').value.trim();
                const button = document.getElementById('btnSearchCheckout');
                button.disabled = true;
                try {
                    const params = new URLSearchParams({ buscar: term, campo: document.getElementById('searchField').value });
                    const response = await fetch(`${page.dataset.searchUrl}?${params}`, { headers: { Accept: 'application/json' } });
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'No se encontró la estadía.');
                    renderStay(data);
                } catch (error) {
                    message(error.message);
                } finally {
                    button.disabled = false;
                }
            });

            document.getElementById('searchValue').addEventListener('keydown', event => {
                if (event.key === 'Enter') document.getElementById('btnSearchCheckout').click();
            });

            document.querySelectorAll('[data-occupied-stay]').forEach(button => button.addEventListener('click', async () => {
                document.getElementById('searchValue').value = button.dataset.occupiedStay;
                document.getElementById('searchField').value = 'reserva';
                document.getElementById('btnSearchCheckout').click();
            }));

            document.getElementById('btnAddConsumption').addEventListener('click', () => {
                const concept = window.prompt('Concepto del consumo:');
                if (!concept?.trim()) return;
                const quantity = Math.max(1, Number(window.prompt('Cantidad:', '1')) || 1);
                const price = Math.max(0, Number(window.prompt('Precio unitario:', '0')) || 0);
                state.consumptions.push({ concept: concept.trim(), quantity, price });
                renderConsumption();
            });

            document.getElementById('btnConfirmCheckout').addEventListener('click', async () => {
                if (!state.stay) return message('Busca una estadía activa primero.');
                const paymentMethod = document.getElementById('paymentMethod').value;
                if (!paymentMethod) return message('Selecciona un método de pago.');
                const response = await fetch(`{{ url('/checkout') }}/${state.stay.id}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json', Accept: 'application/json' },
                    body: JSON.stringify({
                        payment_method: paymentMethod,
                        payment_status: 'pagado',
                        comprobante_tipo: document.getElementById('receiptType').value,
                        observations: document.getElementById('checkoutObservations').value,
                        consumptions: state.consumptions,
                    }),
                });
                const data = await response.json();
                if (!response.ok) return message(data.message || 'No se pudo registrar el check-out.');
                message(data.message);
                showReceipt(data.receipt);
                if (data.receipt_url) {
                    window.open(`${data.receipt_url}?formato=${document.getElementById('receiptType').value}`, '_blank', 'noopener');
                }
            });

            document.getElementById('closeReceipt').addEventListener('click', () => {
                receiptModal.hidden = true;
                receiptModal.setAttribute('aria-hidden', 'true');
                window.location.reload();
            });
            document.getElementById('printReceipt').addEventListener('click', () => window.print());
        })();
    </script>

</x-app-layout>