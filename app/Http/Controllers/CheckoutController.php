<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\MovimientoCaja;
use App\Models\Reserva;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index()
    {
        $habitacionesOcupadas = Habitacion::with(['reservas' => fn ($query) => $query
            ->with('huesped')
            ->whereNull('checked_out_at')
            ->latest('fecha_entrada')])
            ->where('estado', 'ocupada')
            ->orderBy('numero')
            ->get();

        return view('checkout', compact('habitacionesOcupadas'));
    }

    public function search(Request $request): JsonResponse
    {
        $term = trim((string) $request->input('buscar'));
        $field = $request->input('campo');

        $reserva = Reserva::with(['huesped', 'habitacion'])
            ->whereNull('checked_out_at')
            ->whereHas('habitacion', fn ($query) => $query->where('estado', 'ocupada'))
            ->where(function ($query) use ($term, $field) {
                if ($term === '') {
                    return;
                }
                if ($field === 'documento') {
                    $query->whereHas('huesped', fn ($q) => $q->where('numero_documento', 'like', "%{$term}%"));
                } elseif ($field === 'nombre') {
                    $query->whereHas('huesped', fn ($q) => $q->where('nombre', 'like', "%{$term}%"));
                } elseif ($field === 'habitacion') {
                    $query->whereHas('habitacion', fn ($q) => $q->where('numero', 'like', "%{$term}%"));
                } elseif ($field === 'reserva') {
                    $query->where('codigo', 'like', "%{$term}%");
                } else {
                    $query->where('codigo', 'like', "%{$term}%")
                        ->orWhereHas('huesped', fn ($q) => $q->where('nombre', 'like', "%{$term}%")->orWhere('numero_documento', 'like', "%{$term}%"))
                        ->orWhereHas('habitacion', fn ($q) => $q->where('numero', 'like', "%{$term}%"));
                }
            })
            ->latest('fecha_entrada')
            ->first();

        if (!$reserva) {
            return response()->json(['message' => 'No encontramos una estadía activa con esos datos.'], 404);
        }

        $nights = max(1, $reserva->fecha_entrada->diffInDays(now()->startOfDay()));
        $accommodation = $nights * (float) $reserva->habitacion->precio;
        $consumptions = $reserva->consumos ?? [];
        $consumptionsTotal = collect($consumptions)->sum(fn ($item) => (float) ($item['quantity'] ?? 0) * (float) ($item['price'] ?? 0));
        $discount = (float) ($reserva->descuento ?? 0);

        return response()->json([
            'id' => $reserva->id,
            'guest' => [
                'name' => $reserva->huesped->nombre,
                'document' => $reserva->huesped->tipo_documento . ' ' . $reserva->huesped->numero_documento,
            ],
            'reservation' => $reserva->codigo,
            'room' => $reserva->habitacion->numero,
            'room_price' => (float) $reserva->habitacion->precio,
            'checkin' => $reserva->fecha_entrada->format('d/m/Y'),
            'checkout' => $reserva->fecha_salida->format('d/m/Y'),
            'nights' => $nights,
            'accommodation' => $accommodation,
            'consumptions' => $consumptions,
            'consumptions_total' => $consumptionsTotal,
            'discount' => $discount,
            'total' => $accommodation + $consumptionsTotal - $discount,
            'active_rooms' => Reserva::with(['huesped', 'habitacion'])
                ->whereNull('checked_out_at')
                ->whereHas('habitacion', fn ($query) => $query->where('estado', 'ocupada'))
                ->get()
                ->map(fn ($active) => [
                    'id' => $active->id,
                    'room' => $active->habitacion->numero,
                    'guest' => $active->huesped->nombre,
                    'reservation' => $active->codigo,
                ])->values(),
        ]);
    }

    public function receipt(Reserva $reserva)
    {
        abort_unless($reserva->checked_out_at && $reserva->payment_status === 'pagado', 404);

        $reserva->load(['huesped', 'habitacion']);

        return view('factura', compact('reserva'));
    }

    public function movementReceipt(MovimientoCaja $movimiento)
    {
        abort_if($movimiento->tipo === 'egreso', 404);

        $movimiento->movimiento_at = $movimiento->fecha;
        $movimiento->metodo = str($movimiento->observaciones ?? 'Efectivo')
            ->after('Método: ')
            ->toString();

        return view('factura', compact('movimiento'));
    }

    public function store(Request $request, Reserva $reserva): JsonResponse
    {
        $validated = $request->validate([
            'payment_method' => ['required', Rule::in(['efectivo', 'tarjeta', 'yape', 'plin', 'transferencia'])],
            'payment_status' => ['required', Rule::in(['pagado', 'pendiente'])],
            'comprobante_tipo' => ['required', Rule::in(['ticket', 'boleta'])],
            'observations' => ['nullable', 'string', 'max:1000'],
            'consumptions' => ['nullable', 'array'],
            'consumptions.*.concept' => ['required', 'string', 'max:100'],
            'consumptions.*.quantity' => ['required', 'integer', 'min:1'],
            'consumptions.*.price' => ['required', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($validated, $reserva) {
            $reserva = Reserva::with(['huesped', 'habitacion'])->lockForUpdate()->findOrFail($reserva->id);
            if ($reserva->checked_out_at || $reserva->habitacion->estado !== 'ocupada') {
                abort(422, 'Esta estadía ya no está activa.');
            }

            $consumptions = $validated['consumptions'] ?? [];
            $accommodation = max(1, $reserva->fecha_entrada->diffInDays(now()->startOfDay())) * (float) $reserva->habitacion->precio;
            $consumptionsTotal = collect($consumptions)->sum(fn ($item) => $item['quantity'] * $item['price']);
            $reserva->update([
                'checked_out_at' => now(),
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_status'],
                'comprobante_tipo' => $validated['comprobante_tipo'],
                'checkout_notes' => $validated['observations'] ?? null,
                'consumos' => $consumptions,
                'descuento' => 0,
                'total' => $accommodation + $consumptionsTotal,
            ]);
            $reserva->habitacion->update(['estado' => 'libre']);
            $reserva->huesped->update(['habitacion_id' => null, 'estado' => 'inactivo']);
        });

        $reserva = Reserva::with(['huesped', 'habitacion'])->findOrFail($reserva->id);
        $consumptions = $reserva->consumos ?? [];
        $consumptionsTotal = collect($consumptions)->sum(fn ($item) => $item['quantity'] * $item['price']);
        $accommodation = (float) $reserva->total - $consumptionsTotal;

        return response()->json([
            'message' => 'Check-out registrado correctamente.',
            'receipt_url' => route('checkout.receipt', $reserva),
            'receipt' => [
                'type' => $validated['comprobante_tipo'],
                'number' => 'C-' . str_pad((string) $reserva->id, 8, '0', STR_PAD_LEFT),
                'reservation' => $reserva->codigo,
                'guest' => $reserva->huesped->nombre,
                'document' => $reserva->huesped->tipo_documento . ' ' . $reserva->huesped->numero_documento,
                'room' => $reserva->habitacion->numero,
                'checkin' => $reserva->fecha_entrada->format('d/m/Y'),
                'checkout' => $reserva->checked_out_at->format('d/m/Y H:i'),
                'payment_method' => $validated['payment_method'],
                'consumptions' => $consumptions,
                'accommodation' => $accommodation,
                'consumptions_total' => $consumptionsTotal,
                'discount' => (float) $reserva->descuento,
                'total' => (float) $reserva->total,
            ],
        ]);
    }
}
