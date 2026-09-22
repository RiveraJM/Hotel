<x-app-layout>
    @php($editando = isset($huesped))

    @push('styles')
        @vite(['resources/css/huespedes.css'])
    @endpush

    <div class="guest-create-page">
        <main class="guest-create-main">
            <a href="{{ route('huespedes.index') }}" class="guest-back-link">
                <i class="fa-solid fa-arrow-left"></i>
                Volver al directorio
            </a>

            <section class="guest-create-hero">
                <div>
                    <span class="guest-create-eyebrow">GESTIÓN DE HUÉSPEDES</span>
                    <h1>{{ $editando ? 'Editar huésped' : 'Registrar nuevo huésped' }}</h1>
                    <p>{{ $editando ? 'Actualiza la información del huésped seleccionado.' : 'Completa los datos para agregar una persona al directorio del hotel.' }}</p>
                </div>
                <div class="guest-create-hero-icon">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </section>

            @if ($errors->any())
                <div class="guest-form-alert" role="alert">
                    <strong>Revisa la información ingresada.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $editando ? route('huespedes.update', $huesped) : route('huespedes.store') }}" method="POST" class="guest-create-form">
                @csrf
                @if($editando)
                    @method('PUT')
                @endif

                <section class="guest-form-card">
                    <div class="guest-form-card-heading">
                        <div class="guest-form-icon"><i class="fa-solid fa-id-card"></i></div>
                        <div>
                            <h2>Datos personales</h2>
                            <p>Información principal de identificación y contacto.</p>
                        </div>
                    </div>

                    <div class="guest-form-grid">
                        <div class="guest-field guest-field-wide">
                            <label for="nombre">Nombre completo <span>*</span></label>
                            <input id="nombre" name="nombre" type="text" value="{{ old('nombre', $huesped->nombre ?? '') }}" required autofocus placeholder="Ej. María Fernanda Torres">
                        </div>

                        <div class="guest-field">
                            <label for="tipo_documento">Tipo de documento <span>*</span></label>
                            <select id="tipo_documento" name="tipo_documento" required>
                                <option value="">Selecciona una opción</option>
                                <option value="DNI" @selected(old('tipo_documento', $huesped->tipo_documento ?? '') === 'DNI')>DNI</option>
                                <option value="Pasaporte" @selected(old('tipo_documento', $huesped->tipo_documento ?? '') === 'Pasaporte')>Pasaporte</option>
                                <option value="CE" @selected(old('tipo_documento', $huesped->tipo_documento ?? '') === 'CE')>Carné de extranjería</option>
                            </select>
                        </div>

                        <div class="guest-field">
                            <label for="numero_documento">Número de documento <span>*</span></label>
                            <input id="numero_documento" name="numero_documento" type="text" value="{{ old('numero_documento', $huesped->numero_documento ?? '') }}" required placeholder="Ej. 72894561">
                        </div>

                        <div class="guest-field">
                            <label for="email">Correo electrónico</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $huesped->email ?? '') }}" placeholder="correo@ejemplo.com">
                        </div>

                        <div class="guest-field">
                            <label for="telefono">Teléfono</label>
                            <input id="telefono" name="telefono" type="text" value="{{ old('telefono', $huesped->telefono ?? '') }}" placeholder="Ej. 987 654 321">
                        </div>
                    </div>
                </section>

                <section class="guest-form-card">
                    <div class="guest-form-card-heading">
                        <div class="guest-form-icon"><i class="fa-solid fa-hotel"></i></div>
                        <div>
                            <h2>Estadía</h2>
                            <p>Asigna el estado y la habitación del huésped.</p>
                        </div>
                    </div>

                    <div class="guest-form-grid">
                        <div class="guest-field">
                            <label for="estado">Estado <span>*</span></label>
                            <select id="estado" name="estado" required>
                                <option value="inactivo" @selected(old('estado', $huesped->estado ?? 'inactivo') === 'inactivo')>Inactivo</option>
                                <option value="reserva" @selected(old('estado', $huesped->estado ?? '') === 'reserva')>Con reserva</option>
                                <option value="alojado" @selected(old('estado', $huesped->estado ?? '') === 'alojado')>Alojado</option>
                            </select>
                        </div>

                        <div class="guest-field">
                            <label for="habitacion_id">Habitación</label>
                            <select id="habitacion_id" name="habitacion_id">
                                <option value="">Sin habitación asignada</option>
                                @foreach ($habitaciones as $habitacion)
                                    <option value="{{ $habitacion->id }}" @selected((string) old('habitacion_id', $huesped->habitacion_id ?? '') === (string) $habitacion->id)>
                                        Hab. {{ $habitacion->numero }} · Piso {{ $habitacion->piso }} · {{ $habitacion->tipo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="guest-field">
                            <label for="fecha_registro">Fecha de registro <span>*</span></label>
                            <input id="fecha_registro" name="fecha_registro" type="date" value="{{ old('fecha_registro', isset($huesped) ? $huesped->fecha_registro?->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                        </div>
                    </div>
                </section>

                <div class="guest-form-actions">
                    <a href="{{ route('huespedes.index') }}" class="guest-cancel-button">Cancelar</a>
                    <button type="submit" class="guest-save-button">
                        <i class="fa-solid fa-check"></i>
                        {{ $editando ? 'Guardar cambios' : 'Registrar huésped' }}
                    </button>
                </div>
            </form>
        </main>
    </div>
</x-app-layout>
