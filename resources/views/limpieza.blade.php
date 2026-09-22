{{-- =========================================================
     LIMPIEZA
     resources/views/limpieza.blade.php
========================================================= --}}

<x-app-layout>

@vite(['resources/css/limpieza.css'])

@php
    $estadoLabels = [
        'limpia' => 'Limpia',
        'pendiente' => 'Pendiente',
        'en_proceso' => 'En proceso',
        'atencion' => 'Atención',
    ];
    $estadoIcons = [
        'limpia' => 'fa-circle-check',
        'pendiente' => 'fa-broom',
        'en_proceso' => 'fa-spinner',
        'atencion' => 'fa-triangle-exclamation',
    ];
    $counts = $habitaciones->groupBy('limpieza_estado')->map->count();
@endphp


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


            <button class="primary-action" type="button" data-open-cleaning-panel>

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

                    <strong>{{ $counts->get('pendiente', 0) }}</strong>

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

                    <strong>{{ $counts->get('limpia', 0) }}</strong>

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

                    <strong>{{ $counts->get('en_proceso', 0) }}</strong>

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

                    <strong>{{ $counts->get('atencion', 0) }}</strong>

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
                    data-room-search
                >

            </div>


            <div class="filter-group">

                <label>
                    Estado
                </label>

                <select data-room-status-filter>

                    <option value="">Todos los estados</option>

                    @foreach ($estadoLabels as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach

                </select>

            </div>


            <div class="filter-group">

                <label>
                    Prioridad
                </label>

                <select data-room-priority-filter>

                    <option value="">Todas</option>

                    <option value="normal">Normal</option>

                    <option value="alta">Alta</option>

                    <option value="urgente">Urgente</option>

                </select>

            </div>


        </section>



        {{-- =====================================================
             FILTROS RÁPIDOS
        ====================================================== --}}

        <div class="quick-filters">

            <button class="quick-filter active" type="button" data-quick-filter="">
                Todas
            </button>

            <button class="quick-filter" type="button" data-quick-filter="pendiente">
                Pendientes
            </button>

            <button class="quick-filter" type="button" data-quick-filter="en_proceso">
                En proceso
            </button>

            <button class="quick-filter" type="button" data-quick-filter="limpia">
                Limpias
            </button>

            <button class="quick-filter" type="button" data-quick-filter="atencion">
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


                <span class="rooms-count">{{ $habitaciones->count() }} habitaciones registradas</span>

            </div>



            {{-- =================================================
                 GRID PREPARADO PARA BD
            ================================================== --}}

            <div class="cleaning-rooms-grid" data-room-grid>
                @forelse ($habitaciones as $habitacion)
                    @php($roomStatus = $habitacion->limpieza_estado ?: 'pendiente')
                    <button
                        class="cleaning-room-card {{ $roomStatus === 'en_proceso' ? 'process' : $roomStatus }}"
                        type="button"
                        data-room-card
                        data-room-number="{{ $habitacion->numero }}"
                        data-room-status="{{ $roomStatus }}"
                        data-room-priority="{{ $habitacion->limpieza_prioridad ?: 'normal' }}"
                        data-room-id="{{ $habitacion->id }}"
                        data-room-notes="{{ $habitacion->limpieza_notas }}"
                    >
                        <span class="room-number">{{ $habitacion->numero }}</span>
                        <span class="room-status-icon"><i class="fa-solid {{ $estadoIcons[$roomStatus] }}"></i></span>
                        <span class="room-status">{{ strtoupper($estadoLabels[$roomStatus]) }}</span>
                        <span class="room-priority">{{ ucfirst($habitacion->limpieza_prioridad ?: 'normal') }}</span>
                    </button>
                @empty
                    <p class="cleaning-empty-state">No hay habitaciones registradas.</p>
                @endforelse
            </div>

        </section>

        <div class="cleaning-panel-backdrop" data-cleaning-backdrop hidden></div>
        <aside class="cleaning-panel" data-cleaning-panel aria-hidden="true">
            <div class="cleaning-panel-header">
                <div>
                    <span class="cleaning-eyebrow">ACTUALIZACIÓN</span>
                    <h2>Gestionar limpieza</h2>
                </div>
                <button type="button" class="cleaning-panel-close" data-close-cleaning-panel aria-label="Cerrar panel">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <p class="cleaning-panel-help">Selecciona una habitación y registra su condición actual.</p>

            <form method="POST" data-cleaning-form>
                @csrf
                @method('PATCH')
                <label class="cleaning-form-label" for="cleaning-room-select">Habitación</label>
                <select id="cleaning-room-select" class="cleaning-form-control" data-cleaning-room required>
                    <option value="">Selecciona una habitación</option>
                    @foreach ($habitaciones as $habitacion)
                        <option value="{{ $habitacion->id }}">Habitación {{ $habitacion->numero }}</option>
                    @endforeach
                </select>

                <label class="cleaning-form-label" for="cleaning-status-select">Estado</label>
                <select id="cleaning-status-select" name="limpieza_estado" class="cleaning-form-control" required>
                    @foreach ($estadoLabels as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>

                <label class="cleaning-form-label" for="cleaning-priority-select">Prioridad</label>
                <select id="cleaning-priority-select" name="limpieza_prioridad" class="cleaning-form-control" required>
                    <option value="normal">Normal</option>
                    <option value="alta">Alta</option>
                    <option value="urgente">Urgente</option>
                </select>

                <label class="cleaning-form-label" for="cleaning-notes">Notas</label>
                <textarea id="cleaning-notes" name="limpieza_notas" class="cleaning-form-control" rows="4" maxlength="500" placeholder="Ej. Reponer toallas o revisar minibar"></textarea>

                <button type="submit" class="primary-action cleaning-panel-submit" data-cleaning-submit disabled>
                    <i class="fa-solid fa-check"></i>
                    Guardar actualización
                </button>
            </form>
        </aside>



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

    <script>
        (() => {
            const panel = document.querySelector('[data-cleaning-panel]');
            const backdrop = document.querySelector('[data-cleaning-backdrop]');
            const form = document.querySelector('[data-cleaning-form]');
            const roomSelect = document.querySelector('[data-cleaning-room]');
            const statusSelect = document.querySelector('#cleaning-status-select');
            const prioritySelect = document.querySelector('#cleaning-priority-select');
            const notes = document.querySelector('#cleaning-notes');
            const submit = document.querySelector('[data-cleaning-submit]');
            const cards = [...document.querySelectorAll('[data-room-card]')];

            const selectRoom = (card) => {
                roomSelect.value = card.dataset.roomId;
                statusSelect.value = card.dataset.roomStatus;
                prioritySelect.value = card.dataset.roomPriority;
                notes.value = card.dataset.roomNotes || '';
                form.action = `/limpieza/${card.dataset.roomId}`;
                submit.disabled = false;
            };

            const openPanel = (card = null) => {
                if (card) {
                    selectRoom(card);
                } else {
                    roomSelect.value = '';
                    form.action = '';
                    submit.disabled = true;
                }
                panel.hidden = false;
                backdrop.hidden = false;
                requestAnimationFrame(() => panel.classList.add('is-open'));
                panel.setAttribute('aria-hidden', 'false');
            };

            const closePanel = () => {
                panel.classList.remove('is-open');
                panel.setAttribute('aria-hidden', 'true');
                setTimeout(() => { panel.hidden = true; backdrop.hidden = true; }, 180);
            };

            document.querySelector('[data-open-cleaning-panel]').addEventListener('click', () => openPanel());
            document.querySelector('[data-close-cleaning-panel]').addEventListener('click', closePanel);
            backdrop.addEventListener('click', closePanel);
            cards.forEach(card => card.addEventListener('click', () => openPanel(card)));
            roomSelect.addEventListener('change', () => {
                const card = cards.find(item => item.dataset.roomId === roomSelect.value);
                if (card) selectRoom(card);
            });

            const applyFilters = () => {
                const search = document.querySelector('[data-room-search]').value.toLowerCase().trim();
                const status = document.querySelector('[data-room-status-filter]').value;
                const priority = document.querySelector('[data-room-priority-filter]').value;
                cards.forEach(card => {
                    const visible = card.dataset.roomNumber.toLowerCase().includes(search)
                        && (!status || card.dataset.roomStatus === status)
                        && (!priority || card.dataset.roomPriority === priority);
                    card.hidden = !visible;
                });
            };

            document.querySelector('[data-room-search]').addEventListener('input', applyFilters);
            document.querySelector('[data-room-status-filter]').addEventListener('change', applyFilters);
            document.querySelector('[data-room-priority-filter]').addEventListener('change', applyFilters);
            document.querySelectorAll('[data-quick-filter]').forEach(button => button.addEventListener('click', () => {
                document.querySelectorAll('[data-quick-filter]').forEach(item => item.classList.remove('active'));
                button.classList.add('active');
                document.querySelector('[data-room-status-filter]').value = button.dataset.quickFilter;
                applyFilters();
            }));
        })();
    </script>

</x-app-layout>