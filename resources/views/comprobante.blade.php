@php
    $ticket = request('formato', $reserva->comprobante_tipo ?: 'boleta') === 'ticket';
    $consumos = $reserva->consumos ?? [];
    $consumosTotal = collect($consumos)->sum(fn ($item) => (float) $item['quantity'] * (float) $item['price']);
    $alojamiento = (float) $reserva->total - $consumosTotal + (float) $reserva->descuento;
@endphp
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $ticket ? 'Ticket' : 'Boleta' }} {{ $reserva->codigo }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #e8efea; color: #17231f; font-family: Arial, sans-serif; }
        .actions { position: fixed; top: 18px; right: 18px; display: flex; gap: 8px; }
        button, a { padding: 10px 14px; border: 0; border-radius: 5px; background: #063b32; color: #fff; cursor: pointer; text-decoration: none; font-weight: 700; }
        a { background: #c9a227; color: #17231f; }
        .receipt { width: {{ $ticket ? '80mm' : '210mm' }}; min-height: {{ $ticket ? 'auto' : '297mm' }}; margin: 74px auto 30px; padding: {{ $ticket ? '9mm 5mm' : '18mm' }}; background: #fff; box-shadow: 0 10px 35px #063b3233; }
        .brand, h1, .number, .thanks { text-align: center; }
        .brand { color: #063b32; font-size: 22px; font-weight: 800; }
        h1 { margin: 7px 0 4px; font-size: 16px; }
        .number { margin: 0; color: #477568; font-size: 12px; }
        .line { margin: 18px 0; border-top: 1px dashed #9ad2b5; }
        .data, .item, .total { display: flex; justify-content: space-between; gap: 18px; margin: 8px 0; font-size: 13px; }
        .data span, .item span { color: #477568; }
        .total { margin-top: 20px; padding-top: 12px; border-top: 2px solid #063b32; font-size: 18px; font-weight: 800; }
        .thanks { margin-top: 28px; color: #477568; font-size: 12px; }
        @media print { body { background: #fff; } .actions { display: none; } .receipt { width: {{ $ticket ? '80mm' : '210mm' }}; min-height: 0; margin: 0; padding: {{ $ticket ? '5mm' : '12mm' }}; box-shadow: none; } }
    </style>
</head>
<body>
    <div class="actions">
        <a href="{{ route('caja.index') }}">Volver a caja</a>
        <button type="button" onclick="window.print()">Imprimir / PDF</button>
    </div>
    <main class="receipt">
        <div class="brand">HOTEL CIELO</div>
        <h1>{{ $ticket ? 'TICKET DE VENTA' : 'BOLETA DE VENTA' }}</h1>
        <p class="number">C-{{ str_pad((string) $reserva->id, 8, '0', STR_PAD_LEFT) }}</p>
        <div class="line"></div>
        <div class="data"><span>Fecha</span><strong>{{ $reserva->checked_out_at->format('d/m/Y H:i') }}</strong></div>
        <div class="data"><span>Reserva</span><strong>{{ $reserva->codigo }}</strong></div>
        <div class="data"><span>Huésped</span><strong>{{ $reserva->huesped->nombre }}</strong></div>
        <div class="data"><span>Documento</span><strong>{{ $reserva->huesped->tipo_documento }} {{ $reserva->huesped->numero_documento }}</strong></div>
        <div class="data"><span>Habitación</span><strong>{{ $reserva->habitacion->numero }}</strong></div>
        <div class="line"></div>
        <div class="item"><span>Alojamiento</span><strong>S/ {{ number_format($alojamiento, 2) }}</strong></div>
        @foreach ($consumos as $consumo)
            <div class="item"><span>{{ $consumo['quantity'] }} x {{ $consumo['concept'] }}</span><strong>S/ {{ number_format($consumo['quantity'] * $consumo['price'], 2) }}</strong></div>
        @endforeach
        @if ((float) $reserva->descuento > 0)
            <div class="item"><span>Descuento</span><strong>- S/ {{ number_format($reserva->descuento, 2) }}</strong></div>
        @endif
        <div class="total"><span>TOTAL</span><strong>S/ {{ number_format($reserva->total, 2) }}</strong></div>
        <div class="data"><span>Método de pago</span><strong>{{ ucfirst($reserva->payment_method) }}</strong></div>
        <p class="thanks">Gracias por su preferencia.</p>
    </main>
</body>
</html>
