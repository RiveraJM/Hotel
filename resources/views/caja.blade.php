{{-- =========================================================
     CAJA
     resources/views/caja.blade.php
========================================================= --}}

@php
    $currency = fn ($amount) => 'S/ ' . number_format((float) $amount, 2);
    $lastMovement = $movimientos->first();
    $expectedCash = $saldoInicial + $movimientos->where('tipo', 'ingreso')->where('metodo', 'efectivo')->sum('monto') - $movimientos->where('tipo', 'egreso')->where('metodo', 'efectivo')->sum('monto');
@endphp

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Caja | Hotel Management</title>

    {{-- Carga correcta mediante Vite --}}
    @vite(['resources/css/app.css', 'resources/css/caja.css'])
    @vite(['resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>


<body>

@include('layouts.navigation')

<div class="hotel-layout">


    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    @if (false)
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

                    <button class="btn btn-outline" type="button" data-open-history>

                        <i class="fa-solid fa-clock-rotate-left"></i>

                        Historial

                    </button>


                    <button class="btn btn-primary" type="button" data-open-movement>

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

                        <h3>{{ $caja ? 'Caja abierta' : 'Caja cerrada' }}</h3>

                        <p>
                            {{ $caja ? 'La caja se encuentra disponible para registrar movimientos.' : 'Abre una caja para comenzar a registrar movimientos.' }}
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

                        <strong>{{ $caja?->fecha_apertura?->format('d/m/Y H:i') ?? '—' }}</strong>

                    </div>


                    <div class="status-detail">

                        <span>
                            Último movimiento
                        </span>

                        <strong>{{ $lastMovement?->movimiento_at?->format('d/m/Y H:i') ?? '—' }}</strong>

                    </div>


                </div>


                <button class="btn-close-cash" type="button" data-open-{{ $caja ? 'close' : 'open' }}>

                    <i class="fa-solid fa-{{ $caja ? 'lock' : 'unlock' }}"></i>

                    {{ $caja ? 'Cerrar caja' : 'Abrir caja' }}

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
                        {{ $currency($saldoInicial) }}
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
                        {{ $currency($ingresos) }}
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
                        {{ $currency($egresos) }}
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
                        {{ $currency($saldoActual) }}
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


                    <button class="quick-action income-action" type="button" data-open-movement data-movement-type="ingreso">

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



                    <button class="quick-action expense-action" type="button" data-open-movement data-movement-type="egreso">

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



                    <button class="quick-action payment-action" type="button" data-open-movement data-movement-type="ingreso" data-payment-movement>

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


                    <button class="btn-filter" type="button" data-toggle-filters>

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
                            data-movement-search
                        >

                    </div>


                    <select data-movement-type-filter>

                        <option value="">
                            Todos los movimientos
                        </option>

                        <option value="ingreso">
                            Ingresos
                        </option>

                        <option value="egreso">
                            Egresos
                        </option>

                    </select>


                    <select data-movement-method-filter>

                        <option value="">
                            Todos los métodos
                        </option>

                        <option value="efectivo">
                            Efectivo
                        </option>

                        <option value="tarjeta">
                            Tarjeta
                        </option>

                        <option value="transferencia">
                            Transferencia
                        </option>

                    </select>


                    <input
                        type="date"
                        aria-label="Fecha"
                        data-movement-date-filter
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
                                    Comprobante
                                </th>

                            </tr>

                        </thead>


                        <tbody>
    @forelse($movimientos as $movimiento)

        <tr
            data-movement-row
            data-type="{{ $movimiento->tipo }}"
            data-method="{{ $movimiento->metodo }}"
            data-date="{{ $movimiento->movimiento_at->format('Y-m-d') }}"
            data-search="{{ strtolower($movimiento->concepto . ' ' . $movimiento->metodo) }}"
        >

            {{-- Hora --}}
            <td>
                {{ $movimiento->movimiento_at->format('H:i') }}
            </td>

            {{-- Concepto --}}
            <td>
                {{ $movimiento->concepto }}
            </td>

            {{-- Tipo --}}
            <td>
                <span class="movement-type {{ $movimiento->tipo }}">
                    {{ ucfirst($movimiento->tipo) }}
                </span>
            </td>

            {{-- Método de pago --}}
            <td>
                {{ ucfirst($movimiento->metodo) }}
            </td>

            {{-- Monto --}}
            <td class="movement-amount {{ $movimiento->tipo }}">

                {{ $movimiento->tipo === 'egreso' ? '-' : '+' }}

                {{ $currency($movimiento->monto) }}

            </td>

            {{-- Usuario --}}
            <td>
                Administrador
            </td>

            {{-- Estado --}}
            <td>
                <span class="movement-status">
                    {{ ucfirst($movimiento->estado) }}
                </span>
            </td>

            {{-- Comprobante --}}
            <td>

                @if (!empty($movimiento->receipt_url))

                    <a
                        class="movement-receipt-link"
                        href="{{ route('factura.show', ['reserva' => $movimiento->id, 'formato' => 'boleta']) }}"
                        target="_blank"
                        rel="noopener"
                        title="Ver boleta"
                    >

                        <i class="fa-solid fa-file-invoice"></i>

                        <span>
                            Ver boleta
                        </span>

                    </a>

                @elseif ($movimiento->tipo !== 'egreso')

                    <a
                        class="movement-receipt-link"
                        href="{{ route('factura.movement', ['movimiento' => $movimiento->id, 'formato' => 'boleta']) }}"
                        target="_blank"
                        rel="noopener"
                        title="Ver comprobante"
                    >
                        <i class="fa-solid fa-file-invoice"></i>
                        <span>Ver boleta</span>
                    </a>

                @else

                    <span class="movement-no-receipt">
                        Sin comprobante
                    </span>

                @endif

            </td>

        </tr>

    @empty

        <tr class="empty-row">

            <td colspan="8">

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>

                    <strong>
                        No hay ventas pagadas para mostrar
                    </strong>

                    <span>
                        La opción “Ver boleta” aparecerá aquí después
                        de completar un check-out con pago.
                    </span>

                    <a
                        class="empty-state-link"
                        href="{{ route('checkout.index') }}"
                    >
                        Ir a Check-out
                    </a>

                </div>

            </td>

        </tr>

    @endforelse
</tbody>
```


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
                            {{ $currency($saldoInicial) }}
                        </strong>

                    </div>


                    <div class="closing-item">

                        <span>
                            Total ingresos
                        </span>

                        <strong>
                            {{ $currency($ingresos) }}
                        </strong>

                    </div>


                    <div class="closing-item">

                        <span>
                            Total egresos
                        </span>

                        <strong>
                            {{ $currency($egresos) }}
                        </strong>

                    </div>


                    <div class="closing-item highlight">

                        <span>
                            Efectivo esperado
                        </span>

                        <strong>
                            {{ $currency($expectedCash) }}
                        </strong>

                    </div>


                    <div class="closing-item">

                        <span>
                            Efectivo contado
                        </span>

                        <strong>
                            <span data-counted-value>S/ 0.00</span>
                        </strong>

                    </div>


                    <div class="closing-item difference">

                        <span>
                            Diferencia
                        </span>

                        <strong>
                            <span data-difference-value>{{ $currency(-$expectedCash) }}</span>
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
                        data-close-observations
                    ></textarea>

                </div>


                <div class="closing-actions">

                    <button class="btn btn-outline" type="button" data-open-close>

                        Cancelar

                    </button>

                    <button class="btn btn-primary" type="button" data-open-close {{ $caja ? '' : 'disabled' }}>

                        <i class="fa-solid fa-lock"></i>

                        Realizar cierre

                    </button>

                </div>

            </div>


        </section>

    @if (session('status'))
        <div class="cash-flash-message">{{ session('status') }}</div>
    @endif

    <div class="cash-modal-backdrop" data-cash-backdrop hidden></div>

    <section class="cash-modal" data-open-modal hidden aria-hidden="true">
        <div class="cash-modal-header"><div><span class="page-kicker">INICIO DE JORNADA</span><h2>Abrir caja</h2></div><button type="button" data-close-modal aria-label="Cerrar"><i class="fa-solid fa-xmark"></i></button></div>
        <p>Registra el efectivo disponible antes de comenzar la jornada.</p>
        <form method="POST" action="{{ route('caja.open') }}">
            @csrf
            <label for="opening-balance">Saldo inicial</label>
            <input id="opening-balance" name="saldo_inicial" type="number" min="0" step="0.01" required value="0">
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-unlock"></i> Abrir caja</button>
        </form>
    </section>

    <section class="cash-modal" data-movement-modal hidden aria-hidden="true">
        <div class="cash-modal-header"><div><span class="page-kicker">OPERACIÓN</span><h2>Registrar movimiento</h2></div><button type="button" data-close-modal aria-label="Cerrar"><i class="fa-solid fa-xmark"></i></button></div>
        <form method="POST" action="{{ route('caja.movements.store') }}">
            @csrf
            <label for="movement-type">Tipo</label>
            <select id="movement-type" name="tipo" required><option value="ingreso">Ingreso</option><option value="egreso">Egreso</option></select>
            <label for="movement-concept">Concepto</label>
            <input id="movement-concept" name="concepto" type="text" maxlength="180" required placeholder="Ej. Compra de suministros">
            <label for="movement-method">Método</label>
            <select id="movement-method" name="metodo" required><option value="efectivo">Efectivo</option><option value="tarjeta">Tarjeta</option><option value="transferencia">Transferencia</option><option value="yape">Yape</option><option value="plin">Plin</option><option value="otro">Otro</option></select>
            <label for="movement-amount">Monto</label>
            <input id="movement-amount" name="monto" type="number" min="0.01" step="0.01" required>
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-check"></i> Guardar movimiento</button>
        </form>
    </section>

    <section class="cash-modal" data-close-modal-panel hidden aria-hidden="true">
        <div class="cash-modal-header"><div><span class="page-kicker">CONTROL DE CIERRE</span><h2>Cerrar caja</h2></div><button type="button" data-close-modal aria-label="Cerrar"><i class="fa-solid fa-xmark"></i></button></div>
        <p>Compara el efectivo físico con el efectivo esperado antes de cerrar.</p>
        <form method="POST" action="{{ route('caja.close') }}">
            @csrf
            <label for="counted-cash">Efectivo contado</label>
            <input id="counted-cash" name="efectivo_contado" type="number" min="0" step="0.01" required data-counted-cash>
            <label for="close-notes">Observaciones</label>
            <textarea id="close-notes" name="observaciones" rows="4" maxlength="1000" placeholder="Diferencias, incidencias o comentarios"></textarea>
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-lock"></i> Realizar cierre</button>
        </form>
    </section>

    <script>
        (() => {
            const backdrop = document.querySelector('[data-cash-backdrop]');
            const modals = document.querySelectorAll('.cash-modal');
            const open = modal => { modals.forEach(item => item.hidden = true); modal.hidden = false; backdrop.hidden = false; modal.setAttribute('aria-hidden', 'false'); };
            const close = () => { modals.forEach(item => { item.hidden = true; item.setAttribute('aria-hidden', 'true'); }); backdrop.hidden = true; };
            document.querySelector('[data-open-open]')?.addEventListener('click', () => open(document.querySelector('[data-open-modal]')));
            document.querySelector('[data-open-history]')?.addEventListener('click', () => document.querySelector('.movements-panel').scrollIntoView({ behavior: 'smooth' }));
            document.querySelectorAll('[data-open-close]').forEach(button => button.addEventListener('click', () => open(document.querySelector('[data-close-modal-panel]'))));
            document.querySelectorAll('[data-open-movement]').forEach(button => button.addEventListener('click', () => { const modal = document.querySelector('[data-movement-modal]'); const type = button.dataset.movementType; if (type) modal.querySelector('[name="tipo"]').value = type; open(modal); }));
            document.querySelectorAll('[data-close-modal]').forEach(button => button.addEventListener('click', close));
            backdrop.addEventListener('click', close);

            const filterRows = () => {
                const search = document.querySelector('[data-movement-search]').value.toLowerCase().trim();
                const type = document.querySelector('[data-movement-type-filter]').value;
                const method = document.querySelector('[data-movement-method-filter]').value;
                const date = document.querySelector('[data-movement-date-filter]').value;
                document.querySelectorAll('[data-movement-row]').forEach(row => { row.hidden = !row.dataset.search.includes(search) || Boolean(type && row.dataset.type !== type) || Boolean(method && row.dataset.method !== method) || Boolean(date && row.dataset.date !== date); });
            };
            document.querySelectorAll('[data-movement-search], [data-movement-type-filter], [data-movement-method-filter], [data-movement-date-filter]').forEach(input => input.addEventListener(input.tagName === 'INPUT' && input.type === 'text' ? 'input' : 'change', filterRows));
            document.querySelector('[data-counted-cash]')?.addEventListener('input', event => { const expected = {{ $expectedCash }}; const difference = Number(event.target.value || 0) - expected; document.querySelector('[data-difference-value]').textContent = `S/ ${difference.toFixed(2)}`; });
        })();
    </script>

    </main>

</div>

</body>

</html>