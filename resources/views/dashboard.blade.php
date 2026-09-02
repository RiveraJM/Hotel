<x-app-layout>

@vite(['resources/css/dashboard.css'])
    <div class="hotel-dashboard">

        <!-- Header -->
        <header class="hotel-header">
            <div class="header-left"></div>
            <div class="header-right">
                <button class="header-icon-button" type="button">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>
                <div class="header-user">
                    <div class="header-user-avatar">A</div>
                    <div class="header-user-info"><strong>Administrador</strong></div>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
        </header>


        <!-- Content -->
        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">


            <!-- Welcome -->
            <div class="mb-8">

                <h2 class="text-xl font-semibold text-slate-800 dark:text-white">
                    Buenos días, {{ Auth::user()->name }} 👋
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    Aquí tienes un resumen de la actividad del hotel.
                </p>

            </div>


            <!-- Statistics -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                <!-- Habitaciones -->
                <div class="hotel-card p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="hotel-stat-label">
                                Habitaciones
                            </p>

                            <p class="hotel-stat-number mt-2">
                                40
                            </p>

                        </div>

                        <div class="hotel-stat-icon">
                            🛏️
                        </div>

                    </div>

                    <p class="mt-4 text-xs text-slate-500">
                        Total del hotel
                    </p>

                </div>


                <!-- Ocupadas -->
                <div class="hotel-card p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="hotel-stat-label">
                                Ocupadas
                            </p>

                            <p class="hotel-stat-number mt-2">
                                28
                            </p>

                        </div>

                        <div class="hotel-stat-icon hotel-stat-success">
                            ✓
                        </div>

                    </div>

                    <p class="mt-4 text-xs text-emerald-600">
                        70% de ocupación
                    </p>

                </div>


                <!-- Disponibles -->
                <div class="hotel-card p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="hotel-stat-label">
                                Disponibles
                            </p>

                            <p class="hotel-stat-number mt-2">
                                12
                            </p>

                        </div>

                        <div class="hotel-stat-icon hotel-stat-available">
                            🔑
                        </div>

                    </div>

                    <p class="mt-4 text-xs text-slate-500">
                        Listas para reservar
                    </p>

                </div>


                <!-- Ingresos -->
                <div class="hotel-card p-5">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="hotel-stat-label">
                                Ingresos hoy
                            </p>

                            <p class="hotel-stat-number mt-2">
                                S/ 2,850
                            </p>

                        </div>

                        <div class="hotel-stat-icon hotel-stat-revenue">
                            💰
                        </div>

                    </div>

                    <p class="mt-4 text-xs text-emerald-600">
                        +12.5% respecto a ayer
                    </p>

                </div>

            </div>


            <!-- Main Grid -->
            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">


                <!-- Occupancy -->
                <div class="hotel-card p-6 lg:col-span-2">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="text-lg font-semibold text-slate-800 dark:text-white">
                                Ocupación del hotel
                            </h3>

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Estado actual de las habitaciones
                            </p>

                        </div>

                        <span class="hotel-occupancy-badge">
                            70%
                        </span>

                    </div>


                    <!-- Progress -->
                    <div class="mt-6">

                        <div class="mb-2 flex justify-between text-sm">

                            <span class="text-slate-500">
                                Ocupación
                            </span>

                            <span class="font-semibold text-slate-700 dark:text-slate-300">
                                28 / 40
                            </span>

                        </div>


                        <div class="hotel-progress">

                            <div
                                class="hotel-progress-bar"
                                style="width: 70%;"
                            ></div>

                        </div>

                    </div>


                    <!-- Occupancy Stats -->
                    <div class="mt-8 grid grid-cols-3 gap-4 text-center">


                        <div class="hotel-occupancy-box hotel-occupied">

                            <p class="text-2xl font-bold">
                                28
                            </p>

                            <p class="mt-1 text-xs">
                                Ocupadas
                            </p>

                        </div>


                        <div class="hotel-occupancy-box hotel-reserved">

                            <p class="text-2xl font-bold">
                                8
                            </p>

                            <p class="mt-1 text-xs">
                                Reservadas
                            </p>

                        </div>


                        <div class="hotel-occupancy-box hotel-available">

                            <p class="text-2xl font-bold">
                                4
                            </p>

                            <p class="mt-1 text-xs">
                                Disponibles
                            </p>

                        </div>


                    </div>

                </div>


                <!-- Reservations -->
                <div class="hotel-card p-6">

                    <div class="flex items-center justify-between">

                        <h3 class="text-lg font-semibold text-slate-800 dark:text-white">
                            Próximas reservas
                        </h3>

                        <a
                            href="#"
                            class="hotel-view-link"
                        >
                            Ver todas
                        </a>

                    </div>


                    <div class="mt-5">


                        <!-- Juan -->
                        <div class="hotel-reservation">

                            <div class="hotel-avatar">
                                JP
                            </div>

                            <div class="min-w-0 flex-1">

                                <p class="truncate text-sm font-semibold text-slate-800 dark:text-white">
                                    Juan Pérez
                                </p>

                                <p class="text-xs text-slate-500">
                                    Habitación 204
                                </p>

                            </div>

                            <span class="text-xs text-slate-500">
                                28 Ago.
                            </span>

                        </div>


                        <!-- María -->
                        <div class="hotel-reservation">

                            <div class="hotel-avatar">
                                MR
                            </div>

                            <div class="min-w-0 flex-1">

                                <p class="truncate text-sm font-semibold text-slate-800 dark:text-white">
                                    María Rodríguez
                                </p>

                                <p class="text-xs text-slate-500">
                                    Habitación 108
                                </p>

                            </div>

                            <span class="text-xs text-slate-500">
                                29 Ago.
                            </span>

                        </div>


                        <!-- Carlos -->
                        <div class="hotel-reservation">

                            <div class="hotel-avatar">
                                CG
                            </div>

                            <div class="min-w-0 flex-1">

                                <p class="truncate text-sm font-semibold text-slate-800 dark:text-white">
                                    Carlos Gómez
                                </p>

                                <p class="text-xs text-slate-500">
                                    Habitación 305
                                </p>

                            </div>

                            <span class="text-xs text-slate-500">
                                30 Ago.
                            </span>

                        </div>


                    </div>

                </div>

            </div>


            <!-- Quick Actions -->
            <div class="mt-8">

                <h3 class="mb-4 text-lg font-semibold text-slate-800 dark:text-white">
                    Acciones rápidas
                </h3>


                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">


                    <!-- Nueva reserva -->
                    <a href="#" class="hotel-action">

                        <div class="text-2xl">
                            📅
                        </div>

                        <p class="mt-3 font-semibold text-slate-800 dark:text-white">
                            Nueva reserva
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Registrar una reserva
                        </p>

                    </a>


                    <!-- Nuevo huésped -->
                    <a href="#" class="hotel-action">

                        <div class="text-2xl">
                            👤
                        </div>

                        <p class="mt-3 font-semibold text-slate-800 dark:text-white">
                            Nuevo huésped
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Registrar huésped
                        </p>

                    </a>


                    <!-- Check in -->
                    <a href="#" class="hotel-action">

                        <div class="text-2xl">
                            🛎️
                        </div>

                        <p class="mt-3 font-semibold text-slate-800 dark:text-white">
                            Check-in
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Registrar llegada
                        </p>

                    </a>


                    <!-- Check out -->
                    <a href="#" class="hotel-action">

                        <div class="text-2xl">
                            🚪
                        </div>

                        <p class="mt-3 font-semibold text-slate-800 dark:text-white">
                            Check-out
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Registrar salida
                        </p>

                    </a>


                </div>

            </div>


        </main>

    </div>

</x-app-layout>