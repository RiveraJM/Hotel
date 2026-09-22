<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\MovimientoCaja;
use App\Models\Reserva;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CajaController extends Controller
{
    public function index(Request $request): View
    {
        $caja = Caja::query()->where('estado', 'abierta')->whereNull('fecha_cierre')->latest('fecha_apertura')->first();
        $movimientos = $caja?->movimientos()->latest('fecha')->get()->map(function ($movimiento) {
            $movimiento->metodo = 'otro';
            $movimiento->movimiento_at = $movimiento->fecha;
            $movimiento->estado = 'registrado';
            return $movimiento;
        }) ?? collect();
        $pagos = Reserva::with(['habitacion', 'huesped'])
            ->where('payment_status', 'pagado')
            ->whereNotNull('checked_out_at')
            ->latest('checked_out_at')
            ->get();

        $movimientos = $this->mergePayments($movimientos, $pagos);
        $filter = $request->input('tipo');
        if (in_array($filter, ['ingreso', 'egreso'], true)) {
            $movimientos = $movimientos->where('tipo', $filter)->values();
        }

        $ingresos = $movimientos->where('tipo', 'ingreso')->sum('monto');
        $egresos = $movimientos->where('tipo', 'egreso')->sum('monto');
        $saldoInicial = (float) ($caja?->monto_inicial ?? 0);

        return view('caja', [
            'caja' => $caja,
            'movimientos' => $movimientos,
            'saldoInicial' => $saldoInicial,
            'ingresos' => $ingresos,
            'egresos' => $egresos,
            'saldoActual' => $saldoInicial + $ingresos - $egresos,
            'fechaFiltro' => $request->input('fecha'),
            'ventasPagadas' => $pagos->count(),
        ]);
    }

    public function open(Request $request): RedirectResponse
    {
        $validated = $request->validate(['saldo_inicial' => ['required', 'numeric', 'min:0']]);
        if (Caja::where('estado', 'abierta')->whereNull('fecha_cierre')->exists()) {
            return back()->withErrors(['saldo_inicial' => 'Ya existe una caja abierta.']);
        }

        Caja::create([
            'usuario_apertura_id' => auth()->id(),
            'monto_inicial' => $validated['saldo_inicial'],
            'fecha_apertura' => now(),
            'estado' => 'abierta',
            'total_ingresos' => 0,
            'total_egresos' => 0,
        ]);

        return to_route('caja.index')->with('status', 'Caja abierta correctamente.');
    }

    public function storeMovement(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tipo' => ['required', Rule::in(['ingreso', 'egreso'])],
            'metodo' => ['required', Rule::in(['efectivo', 'tarjeta', 'transferencia', 'yape', 'plin', 'otro'])],
            'concepto' => ['required', 'string', 'max:180'],
            'monto' => ['required', 'numeric', 'min:0.01'],
        ]);
        $caja = Caja::where('estado', 'abierta')->whereNull('fecha_cierre')->latest('fecha_apertura')->firstOrFail();
        $caja->movimientos()->create([
            'tipo' => $validated['tipo'], 'concepto' => $validated['concepto'], 'monto' => $validated['monto'],
            'fecha' => now(), 'usuario_id' => auth()->id(), 'observaciones' => 'Método: ' . $validated['metodo'],
        ]);
        $caja->increment($validated['tipo'] === 'ingreso' ? 'total_ingresos' : 'total_egresos', $validated['monto']);

        return to_route('caja.index')->with('status', 'Movimiento registrado correctamente.');
    }

    public function close(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'efectivo_contado' => ['required', 'numeric', 'min:0'],
            'observaciones' => ['nullable', 'string', 'max:1000'],
        ]);
        $caja = Caja::where('estado', 'abierta')->whereNull('fecha_cierre')->latest('fecha_apertura')->firstOrFail();
        $expected = (float) $caja->monto_inicial + (float) $caja->total_ingresos - (float) $caja->total_egresos;
        $caja->update([
            'usuario_cierre_id' => auth()->id(),
            'fecha_cierre' => now(),
            'monto_final' => $validated['efectivo_contado'],
            'diferencia' => (float) $validated['efectivo_contado'] - $expected,
            'estado' => 'cerrada',
            'observaciones' => $validated['observaciones'] ?? null,
        ]);

        return to_route('caja.index')->with('status', 'Caja cerrada correctamente.');
    }

    private function mergePayments(Collection $movimientos, Collection $pagos): Collection
    {
        $pagos = $pagos->map(function (Reserva $reserva) {
            return (object) [
                'id' => $reserva->id,
                'tipo' => 'ingreso',
                'metodo' => $reserva->payment_method ?: 'otro',
                'concepto' => 'Pago reserva ' . $reserva->codigo . ' - Hab. ' . ($reserva->habitacion?->numero ?? 'N/D'),
                'monto' => (float) $reserva->total,
                'estado' => 'pagado',
                'movimiento_at' => $reserva->checked_out_at,
                'receipt_url' => route('factura.show', $reserva),
            ];
        });

        return $movimientos->concat($pagos)->sortByDesc('movimiento_at')->values();
    }
}
