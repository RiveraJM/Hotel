{{-- 
|--------------------------------------------------------------------------
| COMPROBANTE DE PAGO - HOTEL
|--------------------------------------------------------------------------
| Esta vista permite mostrar:
|   ?formato=boleta
|   ?formato=factura
|
| También está preparada para impresión térmica de 80 mm.
|--------------------------------------------------------------------------
--}}

@php
    if (isset($reserva)) {
        $movimiento = (object) [
            'id' => $reserva->id,
            'numero_comprobante' => $reserva->id,
            'movimiento_at' => $reserva->checked_out_at,
            'huesped' => $reserva->huesped,
            'habitacion' => $reserva->habitacion,
            'reserva' => (object) [
                'check_in' => $reserva->fecha_entrada,
                'check_out' => $reserva->checked_out_at,
            ],
            'subtotal' => (float) $reserva->total,
            'total' => (float) $reserva->total,
            'monto' => (float) $reserva->total,
            'metodo' => $reserva->payment_method,
            'concepto' => 'Servicio de hospedaje - Reserva ' . $reserva->codigo,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Tipo de comprobante
    |--------------------------------------------------------------------------
    */
    $formato = request('formato', 'boleta');

    $esFactura = $formato === 'factura';

    $nombreComprobante = $esFactura ? 'FACTURA' : 'BOLETA';
    $serie = $esFactura ? 'F001' : 'B001';

    /*
    |--------------------------------------------------------------------------
    | Datos del hotel
    |--------------------------------------------------------------------------
    | Puedes cambiar estos datos por los reales del hotel.
    |--------------------------------------------------------------------------
    */
    $hotelNombre = 'HOTEL MANAGEMENT';
    $hotelRuc = '20123456789';
    $hotelDireccion = 'Av. Principal 123 - San Martín';
    $hotelTelefono = '999 999 999';
    $hotelEmail = 'hotel@ejemplo.com';

    /*
    |--------------------------------------------------------------------------
    | Datos del comprobante
    |--------------------------------------------------------------------------
    */
    $numeroComprobante = $movimiento->numero_comprobante
        ?? $movimiento->numero
        ?? str_pad($movimiento->id ?? 1, 8, '0', STR_PAD_LEFT);

    $fecha = $movimiento->movimiento_at
        ? $movimiento->movimiento_at->format('d/m/Y H:i')
        : now()->format('d/m/Y H:i');

    /*
    |--------------------------------------------------------------------------
    | Datos del cliente
    |--------------------------------------------------------------------------
    */
    $huesped = $movimiento->huesped ?? null;

    $clienteNombre = $huesped
        ? ($huesped->nombre ?? trim(($huesped->nombres ?? '') . ' ' . ($huesped->apellidos ?? '')))
        : ($movimiento->cliente_nombre ?? 'Cliente de caja');

    $clienteDocumento = $huesped?->numero_documento
        ?? $movimiento->numero_documento
        ?? '---';

    $clienteTipoDocumento = $huesped?->tipo_documento
        ?? $movimiento->tipo_documento
        ?? 'DNI';

    $clienteDireccion = $huesped?->direccion
        ?? $movimiento->cliente_direccion
        ?? '---';

    /*
    |--------------------------------------------------------------------------
    | Datos económicos
    |--------------------------------------------------------------------------
    */
    $subtotal = $movimiento->subtotal
        ?? $movimiento->monto
        ?? 0;

    $igv = $movimiento->igv
        ?? ($subtotal * 0.18);

    $total = $movimiento->total
        ?? $movimiento->monto
        ?? ($subtotal + $igv);

    $metodoPago = ucfirst($movimiento->metodo ?? 'Efectivo');

    /*
    |--------------------------------------------------------------------------
    | Datos de estadía
    |--------------------------------------------------------------------------
    */
    $habitacion = $movimiento->habitacion ?? null;
    $reserva = $movimiento->reserva ?? null;

    $numeroHabitacion = $habitacion->numero
        ?? $movimiento->habitacion_numero
        ?? '---';

    $checkIn = $movimiento->check_in
        ?? $reserva?->check_in
        ?? null;

    $checkOut = $movimiento->check_out
        ?? $reserva?->check_out
        ?? null;

    /*
    |--------------------------------------------------------------------------
    | Concepto
    |--------------------------------------------------------------------------
    */
    $concepto = $movimiento->concepto ?? 'Servicio de hospedaje';

    /*
    |--------------------------------------------------------------------------
    | Función para dinero
    |--------------------------------------------------------------------------
    */
    $money = function ($valor) {
        return 'S/ ' . number_format((float) $valor, 2);
    };
@endphp


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $nombreComprobante }} {{ $serie }}-{{ $numeroComprobante }}
    </title>

    <style>

        /* =========================================================
           CONFIGURACIÓN GENERAL
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f1f5f9;
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
        }

        .ticket-wrapper {
            width: 80mm;
            max-width: 80mm;
            margin: 0 auto;
        }

        .ticket {
            width: 80mm;
            max-width: 80mm;
            background: #ffffff;
            padding: 5mm;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.10);
        }


        /* =========================================================
           ENCABEZADO DEL HOTEL
        ========================================================= */

        .hotel-header {
            text-align: center;
            margin-bottom: 12px;
        }

        .hotel-name {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hotel-info {
            margin-top: 5px;
            font-size: 10px;
            line-height: 1.5;
            color: #374151;
        }


        /* =========================================================
           TÍTULO DEL COMPROBANTE
        ========================================================= */

        .document-box {
            border: 1px solid #111827;
            padding: 8px 5px;
            margin: 10px 0;
            text-align: center;
        }

        .document-type {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .document-number {
            font-size: 12px;
            font-weight: 700;
        }


        /* =========================================================
           INFORMACIÓN DEL CLIENTE
        ========================================================= */

        .section {
            margin-top: 10px;
        }

        .section-title {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            border-bottom: 1px dashed #555;
            padding-bottom: 3px;
            margin-bottom: 5px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            font-size: 10px;
            line-height: 1.6;
        }

        .info-label {
            font-weight: 700;
        }

        .info-value {
            text-align: right;
        }


        /* =========================================================
           DETALLE DEL CONSUMO
        ========================================================= */

        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .items th {
            font-size: 9px;
            text-align: left;
            border-bottom: 1px dashed #555;
            padding: 4px 0;
        }

        .items td {
            font-size: 10px;
            padding: 5px 0;
            vertical-align: top;
        }

        .items .amount {
            text-align: right;
            white-space: nowrap;
        }


        /* =========================================================
           TOTALES
        ========================================================= */

        .totals {
            margin-top: 8px;
            border-top: 1px dashed #555;
            padding-top: 6px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            padding: 2px 0;
        }

        .total-final {
            margin-top: 5px;
            padding-top: 6px;
            border-top: 1px solid #111827;
            font-size: 14px;
            font-weight: 800;
        }


        /* =========================================================
           MÉTODO DE PAGO
        ========================================================= */

        .payment {
            margin-top: 10px;
            padding: 6px 0;
            border-top: 1px dashed #555;
            border-bottom: 1px dashed #555;
        }


        /* =========================================================
           PIE DEL COMPROBANTE
        ========================================================= */

        .footer {
            text-align: center;
            margin-top: 14px;
        }

        .footer-message {
            font-size: 10px;
            font-weight: 700;
        }

        .footer-small {
            margin-top: 4px;
            font-size: 9px;
            color: #4b5563;
            line-height: 1.4;
        }


        /* =========================================================
           BOTONES DE PANTALLA
        ========================================================= */

        .print-actions {
            width: 80mm;
            max-width: 80mm;
            margin: 15px auto;
            display: flex;
            gap: 8px;
        }

        .print-button {
            flex: 1;
            border: 0;
            padding: 10px;
            border-radius: 6px;
            background: #1e3a5f;
            color: white;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
        }

        .print-button:hover {
            background: #162f4d;
        }

        .back-button {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 6px;
            background: #e5e7eb;
            color: #111827;
            font-size: 12px;
            font-weight: 700;
        }


        /* =========================================================
           IMPRESIÓN TÉRMICA
           80mm
        ========================================================= */

        @media print {

            @page {
                size: 80mm auto;
                margin: 0;
            }

            html,
            body {
                width: 80mm;
                margin: 0;
                padding: 0;
                background: #ffffff;
            }

            .ticket-wrapper {
                width: 80mm;
                max-width: 80mm;
                margin: 0;
            }

            .ticket {
                width: 80mm;
                max-width: 80mm;
                padding: 4mm;
                box-shadow: none;
            }

            .print-actions {
                display: none !important;
            }

            .hotel-name {
                font-size: 17px;
            }

            .document-type {
                font-size: 14px;
            }

            .items td,
            .items th {
                font-size: 9px;
            }

            .info-row {
                font-size: 9px;
            }

            .footer-message {
                font-size: 9px;
            }
        }

    </style>
</head>


<body>

    {{-- =========================================================
         BOTONES
    ========================================================== --}}

    <div class="print-actions">

        <button
            type="button"
            class="print-button"
            onclick="window.print()"
        >
            🖨 Imprimir
        </button>

        <a
            href="javascript:history.back()"
            class="back-button"
        >
            Volver
        </a>

    </div>


    {{-- =========================================================
         TICKET
    ========================================================== --}}

    <div class="ticket-wrapper">

        <div class="ticket">


            {{-- =================================================
                 HOTEL
            ================================================== --}}

            <div class="hotel-header">

                <h1 class="hotel-name">
                    {{ $hotelNombre }}
                </h1>

                <div class="hotel-info">

                    RUC: {{ $hotelRuc }}<br>

                    {{ $hotelDireccion }}<br>

                    Tel: {{ $hotelTelefono }}<br>

                    {{ $hotelEmail }}

                </div>

            </div>


            {{-- =================================================
                 COMPROBANTE
            ================================================== --}}

            <div class="document-box">

                <div class="document-type">
                    {{ $nombreComprobante }}
                </div>

                <div class="document-number">
                    {{ $serie }}-{{ $numeroComprobante }}
                </div>

            </div>


            {{-- =================================================
                 DATOS DEL CLIENTE
            ================================================== --}}

            <div class="section">

                <div class="section-title">
                    Datos del cliente
                </div>

                <div class="info-row">

                    <span class="info-label">
                        Cliente:
                    </span>

                    <span class="info-value">
                        {{ $clienteNombre }}
                    </span>

                </div>

                <div class="info-row">

                    <span class="info-label">
                        {{ $clienteTipoDocumento }}:
                    </span>

                    <span class="info-value">
                        {{ $clienteDocumento }}
                    </span>

                </div>

                @if ($esFactura)

                    <div class="info-row">

                        <span class="info-label">
                            Dirección:
                        </span>

                        <span class="info-value">
                            {{ $clienteDireccion }}
                        </span>

                    </div>

                @endif

                <div class="info-row">

                    <span class="info-label">
                        Fecha:
                    </span>

                    <span class="info-value">
                        {{ $fecha }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                 INFORMACIÓN DE HOSPEDAJE
            ================================================== --}}

            <div class="section">

                <div class="section-title">
                    Detalle de hospedaje
                </div>

                <div class="info-row">

                    <span class="info-label">
                        Habitación:
                    </span>

                    <span class="info-value">
                        {{ $numeroHabitacion }}
                    </span>

                </div>

                @if ($checkIn)

                    <div class="info-row">

                        <span class="info-label">
                            Check-in:
                        </span>

                        <span class="info-value">
                            {{ \Carbon\Carbon::parse($checkIn)->format('d/m/Y H:i') }}
                        </span>

                    </div>

                @endif

                @if ($checkOut)

                    <div class="info-row">

                        <span class="info-label">
                            Check-out:
                        </span>

                        <span class="info-value">
                            {{ \Carbon\Carbon::parse($checkOut)->format('d/m/Y H:i') }}
                        </span>

                    </div>

                @endif

            </div>


            {{-- =================================================
                 DETALLE
            ================================================== --}}

            <div class="section">

                <div class="section-title">
                    Detalle

                </div>

                <table class="items">

                    <thead>

                        <tr>

                            <th>
                                Descripción
                            </th>

                            <th class="amount">
                                Importe
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>
                                {{ $concepto }}
                            </td>

                            <td class="amount">
                                {{ $money($subtotal) }}
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                 TOTALES
            ================================================== --}}

            <div class="totals">

                <div class="total-row">

                    <span>
                        Op. gravada
                    </span>

                    <span>
                        {{ $money($subtotal) }}
                    </span>

                </div>

                <div class="total-row">

                    <span>
                        IGV (18%)
                    </span>

                    <span>
                        {{ $money($igv) }}
                    </span>

                </div>

                <div class="total-row total-final">

                    <span>
                        TOTAL
                    </span>

                    <span>
                        {{ $money($total) }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                 PAGO
            ================================================== --}}

            <div class="payment">

                <div class="info-row">

                    <span class="info-label">
                        Forma de pago:
                    </span>

                    <span class="info-value">
                        {{ $metodoPago }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                 PIE
            ================================================== --}}

            <div class="footer">

                <div class="footer-message">
                    ¡Gracias por su preferencia!
                </div>

                <div class="footer-small">

                    Conserve este comprobante.<br>

                    Documento generado por el sistema
                    de gestión hotelera.

                </div>

            </div>


        </div>

    </div>


    {{-- =========================================================
         IMPRESIÓN AUTOMÁTICA OPCIONAL
    ========================================================== --}}

    <script>

        /*
        |--------------------------------------------------------------------------
        | Si quieres que el ticket se abra y automáticamente muestre
        | la ventana de impresión, puedes descomentar estas líneas.
        |--------------------------------------------------------------------------
        */

        // window.addEventListener('load', function () {
        //     window.print();
        // });

    </script>

</body>

</html>
