
<x-app-layout>

    @push('styles')
        @vite(['resources/css/habitacion-show.css'])
    @endpush

    @php
        $estado = strtolower($habitacion->estado);

        $estadoConfig = [
            'libre' => [
                'label' => 'Disponible',
                'class' => 'status-available',
                'icon' => 'fa-solid fa-check'
            ],
            'reservada' => [
                'label' => 'Reservada',
                'class' => 'status-reserved',
                'icon' => 'fa-solid fa-calendar-check'
            ],
            'ocupada' => [
                'label' => 'Ocupada',
                'class' => 'status-occupied',
                'icon' => 'fa-solid fa-user'
            ],
            'mantenimiento' => [
                'label' => 'Mantenimiento',
                'class' => 'status-maintenance',
                'icon' => 'fa-solid fa-screwdriver-wrench'
            ],
        ];

        $estadoActual = $estadoConfig[$estado] ?? [
            'label' => ucfirst($habitacion->estado),
            'class' => 'status-default',
            'icon' => 'fa-solid fa-circle-info'
        ];
    @endphp

    <div class="room-detail-page">

        <header class="room-detail-header">
            <div class="room-detail-heading">
                

                <div class="room-title-row">
                    <div class="room-number-badge">{{ $habitacion->numero }}</div>

                    <div>
                        <span class="room-section-label">DETALLE DE HABITACIÓN</span>
                        <h1>Habitación {{ $habitacion->numero }}</h1>
                        <p>Información general y estado actual.</p>
                    </div>
                </div>
            </div>

            <div class="room-header-actions">
                <a href="{{ route('habitaciones.index') }}" class="room-secondary-button">
                    <i class="fa-solid fa-arrow-left"></i>
                    Volver
                </a>

                <form method="POST" action="{{ route('habitaciones.updateStatus', $habitacion) }}" class="room-status-form">
                    @csrf
                    @method('PATCH')
                    <label class="sr-only" for="estado">Estado de la habitación</label>
                    <select id="estado" name="estado" class="room-status-select" onchange="this.form.submit()">
                            <option value="libre" {{ $habitacion->estado === 'libre' ? 'selected' : '' }}>Disponible</option>
                            <option value="reservada" {{ $habitacion->estado === 'reservada' ? 'selected' : '' }}>Reservada</option>
                            <option value="ocupada" {{ $habitacion->estado === 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                            <option value="mantenimiento" {{ $habitacion->estado === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                    </select>
                </form>

                @if($estado === 'libre')
                    <button type="button" class="room-context-action reserve">
                        <a class="reservation-primary-button" href="{{ route('reservas.create') }}">
                        Nueva reserva
                        </a>
                    </button>
                @elseif($estado === 'reservada')
                    <button type="button" class="room-context-action reservation">
                        <i class="fa-solid fa-calendar-check"></i>
                        Ver reserva
                    </button>
                @elseif($estado === 'ocupada')
                    <button type="button" class="room-context-action occupied">
                        <i class="fa-solid fa-user"></i>
                        Ver huésped
                    </button>
                @elseif($estado === 'mantenimiento')
                    <button type="button" class="room-context-action maintenance">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        Ver mantenimiento
                    </button>
                @endif
            </div>
        </header>

        

        <div class="room-detail-grid">
            <div class="room-detail-main-column">
                <section class="room-card room-information-card">
                <div class="room-card-header">
                    <div class="room-card-title">
                        <div class="room-card-icon blue"><i class="fa-solid fa-bed"></i></div>
                        <div>
                            <h2>Información</h2>
                            <p>Características registradas</p>
                        </div>
                    </div>
                </div>

                <div class="room-information-grid">
                    <div class="room-information-item">
                        <span class="room-information-label">Número</span>
                        <strong>{{ $habitacion->numero }}</strong>
                    </div>

                    <div class="room-information-item">
                        <span class="room-information-label">Piso</span>
                        <strong>{{ $habitacion->piso }}</strong>
                    </div>

                    <div class="room-information-item">
                        <span class="room-information-label">Tipo</span>
                        <strong>{{ $habitacion->tipo }}</strong>
                    </div>

                    <div class="room-information-item">
                        <span class="room-information-label">Capacidad</span>
                        <strong>{{ $habitacion->capacidad }} {{ $habitacion->capacidad == 1 ? 'persona' : 'personas' }}</strong>
                    </div>

                    <div class="room-information-item room-price-item" style="grid-column: 1 / -1;">
                        <span class="room-information-label">Precio por noche</span>
                        <strong>S/ {{ number_format($habitacion->precio, 2) }}</strong>
                    </div>
                </div>
                </section>

                <section class="room-card room-description-card">
                <div class="room-card-header">
                    <div class="room-card-title">
                        <div class="room-card-icon gold"><i class="fa-solid fa-align-left"></i></div>
                        <div>
                            <h2>Descripción</h2>
                            <p>Información adicional</p>
                        </div>
                    </div>
                </div>

                <div class="room-description-content">
                    @if($habitacion->descripcion)
                        <p>{{ $habitacion->descripcion }}</p>
                    @else
                        <div class="room-empty-description">
                            <div><i class="fa-regular fa-file-lines"></i></div>
                            <strong>Sin descripción registrada</strong>
                            <span>Esta habitación todavía no tiene información adicional.</span>
                        </div>
                    @endif
                </div>
                </section>
            </div>

            <aside class="room-card room-gallery-card">
                <div class="room-card-header">
                    <div class="room-card-title">
                        <div class="room-card-icon gold"><i class="fa-regular fa-image"></i></div>
                        <div>
                            <h2>Galería</h2>
                            <p>Vista de la habitación</p>
                        </div>
                    </div>
                </div>

                <div class="room-gallery-content">
                    @foreach ($imagenes as $index => $imagen)
                        <figure class="room-gallery-item {{ $index === 0 ? 'featured' : '' }}">
                            <img src="{{ $imagen }}" alt="Habitación {{ $habitacion->numero }}">
                        </figure>
                    @endforeach
                </div>
            </aside>

           

          
        </div>
    </div>

    
</x-app-layout>
```
