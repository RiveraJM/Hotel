<x-app-layout>
    @php
        $editando = isset($reserva);
        $asignando = isset($habitacion) && !$editando;
    @endphp

    @push('styles')
        @vite(['resources/css/reservas.css'])
    @endpush

    <div class="reservation-create-page">
        <main class="reservation-create-main">
            <a href="{{ route('reservas.index') }}" class="reservation-back-link">
                <i class="fa-solid fa-arrow-left"></i> Volver a reservas
            </a>

            <section class="reservation-create-hero">
                <div>
                    <span>GESTIÓN DE RESERVAS</span>
                    <h1>{{ $editando ? 'Editar reserva' : ($asignando ? 'Asignar huésped' : 'Nueva reserva') }}</h1>
                    <p>{{ $asignando ? 'Completa los datos para asignar un huésped a la habitación reservada.' : 'Selecciona un huésped, una habitación y el estado de la reserva.' }}</p>
                </div>
                <i class="fa-solid fa-calendar-plus"></i>
            </section>

            @if ($errors->any())
                <div class="reservation-form-alert">
                    <strong>Revisa los datos ingresados.</strong>
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ $editando ? route('reservas.update', $reserva) : ($asignando ? route('reservas.assign.store', $habitacion) : route('reservas.store')) }}" method="POST" class="reservation-create-form">
                @csrf
                @if($editando)
                    @method('PUT')
                @endif
                <section class="reservation-form-card">
                    <h2><i class="fa-solid fa-user"></i> Datos de la reserva</h2>
                    <div class="reservation-form-grid">
                        <div class="reservation-guest-picker">
                            <label for="buscar_dni">Buscar huésped por DNI</label>
                            <div class="reservation-dni-search">
                                <i class="fa-solid fa-id-card"></i>
                                <input id="buscar_dni" type="search" placeholder="Escribe el DNI para encontrarlo..." autocomplete="off">
                            </div>
                            <label for="huesped_id">Huésped</label>
                            <select id="huesped_id" name="huesped_id" required>
                                <option value="">Selecciona un huésped</option>
                                @foreach ($huespedes as $huesped)
                                    <option value="{{ $huesped->id }}" data-dni="{{ $huesped->numero_documento }}" data-nombre="{{ $huesped->nombre }}" @selected(old('huesped_id', $reserva->huesped_id ?? '') == $huesped->id)>{{ $huesped->nombre }} · DNI {{ $huesped->numero_documento }}</option>
                                @endforeach
                            </select>
                            <small id="reservation-guest-match">Escribe un DNI para filtrar la lista.</small>
                        </div>
                        <label>{{ $asignando ? 'Habitación reservada' : 'Habitación' }} <select name="habitacion_id" required {{ $asignando ? 'disabled' : '' }}>
                            <option value="">Selecciona una habitación</option>
                            @foreach ($habitaciones as $habitacion)
                                <option value="{{ $habitacion->id }}" @selected(old('habitacion_id', $reserva->habitacion_id ?? $habitacion->id) == $habitacion->id)>Hab. {{ $habitacion->numero }} · Piso {{ $habitacion->piso }} · {{ $habitacion->tipo }}</option>
                            @endforeach
                        </select></label>
                        <label>Fecha de entrada <input type="date" name="fecha_entrada" value="{{ old('fecha_entrada', isset($reserva) ? $reserva->fecha_entrada?->format('Y-m-d') : '') }}" required></label>
                        <label>Fecha de salida <input type="date" name="fecha_salida" value="{{ old('fecha_salida', isset($reserva) ? $reserva->fecha_salida?->format('Y-m-d') : '') }}" required></label>
                        <label>Cantidad de huéspedes <input type="number" name="cantidad_huespedes" min="1" max="20" value="{{ old('cantidad_huespedes', $reserva->cantidad_huespedes ?? 1) }}" required></label>
                        <label>Estado <select name="estado" required>
                            <option value="pendiente" @selected(old('estado', $reserva->estado ?? 'pendiente') === 'pendiente')>Pendiente</option>
                            <option value="confirmada" @selected(old('estado', $reserva->estado ?? '') === 'confirmada')>Confirmada</option>
                            <option value="cancelada" @selected(old('estado', $reserva->estado ?? '') === 'cancelada')>Cancelada</option>
                        </select></label>
                    </div>
                </section>

                <section class="reservation-form-card reserved-check-card">
                    <div class="reserved-check-heading">
                        <div><h2><i class="fa-solid fa-bed"></i> Habitaciones reservadas</h2><p>Consulta las habitaciones que ya tienen estado reservado antes de elegir.</p></div>
                        <strong>{{ $habitacionesReservadas->count() }}</strong>
                    </div>
                    <div class="reserved-room-list">
                        @forelse ($habitacionesReservadas as $habitacion)
                            <span class="reserved-room-chip"><b>{{ $habitacion->numero }}</b> Piso {{ $habitacion->piso }} · Reservada</span>
                        @empty
                            <span class="reserved-empty">No hay habitaciones reservadas actualmente.</span>
                        @endforelse
                    </div>
                </section>

                <div class="reservation-form-actions">
                    <a href="{{ route('reservas.index') }}">Cancelar</a>
                    <button type="submit"><i class="fa-solid fa-check"></i> Guardar reserva</button>
                </div>
            </form>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dniInput = document.getElementById('buscar_dni');
            const guestSelect = document.getElementById('huesped_id');
            const matchMessage = document.getElementById('reservation-guest-match');
            const guestOptions = Array.from(guestSelect.options).slice(1);

            dniInput.addEventListener('input', function () {
                const search = dniInput.value.trim().toLowerCase();
                let matches = 0;

                guestOptions.forEach(function (option) {
                    const matchesDni = option.dataset.dni.toLowerCase().includes(search);
                    option.hidden = Boolean(search) && !matchesDni;
                    option.disabled = Boolean(search) && !matchesDni;
                    if (matchesDni) matches += 1;
                });

                if (!search) {
                    matchMessage.textContent = 'Escribe un DNI para filtrar la lista.';
                } else if (matches === 0) {
                    guestSelect.value = '';
                    matchMessage.textContent = 'No se encontró un huésped con ese DNI.';
                } else if (matches === 1) {
                    const match = guestOptions.find(option => !option.disabled);
                    guestSelect.value = match.value;
                    matchMessage.textContent = 'Huésped encontrado y seleccionado.';
                } else {
                    guestSelect.value = '';
                    matchMessage.textContent = matches + ' huéspedes coinciden con ese DNI.';
                }
            });
        });
    </script>
</x-app-layout>