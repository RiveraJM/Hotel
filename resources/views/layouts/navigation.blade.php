<nav x-data="{ open: false }">

    <!-- Mobile top bar -->
    <div class="lg:hidden flex items-center justify-between bg-[#063b32] px-4 py-4 text-white">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#34a37a] text-xl">
                🏨
            </div>

            <div>
                <div class="text-sm font-bold tracking-wide">
                    HOTEL
                </div>

                <div class="text-xs text-[#9ad2b5]">
                    CIELO
                </div>
            </div>
        </a>

        <button
            @click="open = !open"
            class="rounded-lg p-2 text-[#9ad2b5] hover:bg-[#007a5e]"
        >
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    x-show="!open"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />

                <path
                    x-show="open"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

    </div>


    <!-- Sidebar -->
    <aside
        :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
        class="fixed inset-y-0 left-0 z-50 flex w-64 transform flex-col bg-[#063b32] text-white shadow-[0_0_25px_rgba(6,59,50,0.35)] transition-transform duration-300 lg:translate-x-0"
    >

        <!-- Logo -->
        <div class="flex h-20 items-center border-b border-[#007a5e] px-6 bg-[#063b32]">

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#34a37a] text-2xl shadow-lg">
                    🏨
                </div>

                <div>
                    <div class="text-sm font-bold tracking-widest">
                        HOTEL
                    </div>

                    <div class="text-xs font-medium tracking-wider text-[#9ad2b5]">
                        CIELO
                    </div>
                </div>

            </a>

        </div>


        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto px-4 py-6">

            <!-- General -->
            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-emerald-200/80">
                Principal
            </p>

            <nav class="space-y-1">

                <!-- Dashboard -->
                <a
                    href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard')
                        ? 'bg-[#007a5e] text-white shadow-sm'
                        : 'text-emerald-100/80 hover:bg-[#34a37a] hover:text-white' }}
                        group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">📊</span>
                    <span>Dashboard</span>

                    @if(request()->routeIs('dashboard'))
                        <span class="ml-auto h-2 w-2 rounded-full bg-[#9ad2b5]"></span>
                    @endif
                </a>


            
                <!-- Habitaciones -->
                <a
                    href="{{ route('habitaciones.index') }}"
                    class="{{ request()->routeIs('habitaciones.*') ? 'bg-[#007a5e] text-white shadow-sm' : 'text-emerald-100/80 hover:bg-[#34a37a] hover:text-white' }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">🛏️</span>
                    <span>Habitaciones</span>
                </a>



                <!-- Huéspedes -->
                <a
                    href="{{ route('huespedes.index') }}"
                    class="{{ request()->routeIs('huespedes.*') ? 'bg-[#007a5e] text-white shadow-sm' : 'text-emerald-100/80 hover:bg-[#34a37a] hover:text-white' }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">👥</span>
                    <span>Huéspedes</span>
                </a>


                <!-- Reservas -->
                <a
                    href="{{ route('reservas.index') }}"
                    class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-emerald-100/80 transition hover:bg-[#34a37a] hover:text-white"
                >
                    <span class="text-lg">📅</span>
                    <span>Reservas</span>
                </a>

            </nav>


            <!-- Operaciones -->
            <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-emerald-200/80">
                Operaciones
            </p>

            <nav class="space-y-1">

                <!-- Check in -->
                <a
                    href="{{ route('checkin.index') }}"
                    class="{{ request()->routeIs('checkin.*') ? 'bg-[#007a5e] text-white shadow-sm' : 'text-emerald-100/80 hover:bg-[#34a37a] hover:text-white' }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">🛎️</span>
                    <span>Check-in</span>
                </a>


                <!-- Check out -->
                <a
                    href="{{ route('checkout.index') }}"
                    class="{{ request()->routeIs('checkout.*') ? 'bg-[#007a5e] text-white shadow-sm' : 'text-emerald-100/80 hover:bg-[#34a37a] hover:text-white' }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">🚪</span>
                    <span>Check-out</span>
                </a>

                <!-- Limpieza -->
                <a
                    href="{{ route('limpieza.index') }}"
                    class="{{ request()->routeIs('limpieza.*') ? 'bg-[#007a5e] text-white shadow-sm' : 'text-emerald-100/80 hover:bg-[#34a37a] hover:text-white' }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">🧹</span>
                    <span>Limpieza</span>
                </a>


                <!-- Mantenimiento -->
                <a
                    href="{{ route('mantenimiento.index') }}"
                    class="{{ request()->routeIs('mantenimiento.*') ? 'bg-[#007a5e] text-white shadow-sm' : 'text-emerald-100/80 hover:bg-[#34a37a] hover:text-white' }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">🔧</span>
                    <span>Mantenimiento</span>
                </a>

            </nav>


            <!-- Administración -->
            <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-emerald-200/80">
                Administración
            </p>

            <nav class="space-y-1">

                <!-- Caja -->
                <a
                    href="{{ route('caja.index') }}"
                    class="{{ request()->routeIs('caja.*') ? 'bg-[#007a5e] text-white shadow-sm' : 'text-emerald-100/80 hover:bg-[#34a37a] hover:text-white' }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition"
                >
                    <span class="text-lg">💰</span>
                    <span>Caja</span>
                </a>


                <!-- Reportes -->
                <a
                    href="{{ route('reportes.index') }}"
                    class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-400 transition hover:bg-slate-900 hover:text-white"
                >
                    <span class="text-lg">📈</span>
                    <span>Reportes</span>
                </a>


                <!-- Configuración -->
                <a
                    href="#"
                    class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-400 transition hover:bg-slate-900 hover:text-white"
                >
                    <span class="text-lg">⚙️</span>
                    <span>Configuración</span>
                </a>

            </nav>

        </div>


        <!-- User section -->
        <div class="border-t border-[#007a5e] bg-[#063b32] p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#34a37a] font-bold text-[#063b32]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-semibold text-white">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="truncate text-xs text-slate-500">
                        {{ Auth::user()->email }}
                    </p>

                </div>

            </div>


            <div class="mt-3 grid grid-cols-2 gap-2">

                <a
                    href="{{ route('profile.edit') }}"
                    class="rounded-lg bg-[#007a5e] px-3 py-2 text-center text-xs font-medium text-emerald-100/80 transition hover:bg-[#34a37a] hover:text-white"
                >
                    Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="w-full rounded-lg bg-[#007a5e] px-3 py-2 text-xs font-medium text-[#dfe9e2] transition hover:bg-[#34a37a] hover:text-white"
                    >
                        Salir
                    </button>
                </form>

            </div>

        </div>

    </aside>


    <!-- Mobile overlay -->
    <div
        x-show="open"
        @click="open = false"
        class="fixed inset-0 z-40 bg-[#063b32]/60 lg:hidden"
        x-cloak
    ></div>

</nav>