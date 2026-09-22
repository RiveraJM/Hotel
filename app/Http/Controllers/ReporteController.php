<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Huesped;
use App\Models\MovimientoCaja;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReporteController extends Controller
{
    public function index(Request $request): View
    {
        [$from, $to, $period] = $this->period($request);
        $days = max(1, $from->diffInDays($to) + 1);

        $reservas = Reserva::with(['habitacion', 'huesped'])
            ->whereBetween('created_at', [$from->startOfDay(), $to->endOfDay()])
            ->get();
        $pagos = Reserva::with(['habitacion', 'huesped'])
            ->where('payment_status', 'pagado')
            ->whereNotNull('checked_out_at')
            ->whereBetween('checked_out_at', [$from->startOfDay(), $to->endOfDay()])
            ->get();
        $movimientosCaja = MovimientoCaja::query()
            ->whereBetween('fecha', [$from->startOfDay(), $to->endOfDay()])
            ->get();
        $habitaciones = Habitacion::orderBy('numero')->get();
        $totalHabitaciones = $habitaciones->count();
        $ocupadas = $habitaciones->where('estado', 'ocupada')->count();
        $ocupacion = $totalHabitaciones ? round(($ocupadas / $totalHabitaciones) * 100) : 0;

        $reservasPorEstado = $reservas->groupBy('estado')->map->count();
        $metodosPago = $pagos->groupBy(fn ($reserva) => $reserva->payment_method ?: 'otro')
            ->map(fn ($items) => (float) $items->sum('total'));
        $ingresos = (float) $pagos->sum('total') + (float) $movimientosCaja->where('tipo', 'ingreso')->sum('monto');
        $basePagos = max(0.01, $metodosPago->sum());

        $rendimiento = $habitaciones->map(function (Habitacion $habitacion) use ($reservas, $days, $from, $to) {
            $roomReservations = $reservas->where('habitacion_id', $habitacion->id);
            $nights = $roomReservations->sum(function (Reserva $reserva) use ($days, $from, $to) {
                $start = Carbon::parse($reserva->fecha_entrada)->max($from);
                $end = Carbon::parse($reserva->fecha_salida)->min($to->copy()->addDay());
                return min($days, max(0, $start->diffInDays($end)));
            });
            $revenue = (float) $roomReservations->where('payment_status', 'pagado')->sum('total');
            $occupancy = min(100, round(($nights / max(1, $days)) * 100));

            return (object) [
                'numero' => $habitacion->numero,
                'reservas' => $roomReservations->count(),
                'noches' => $nights,
                'ocupacion' => $occupancy,
                'ingresos' => $revenue,
                'rendimiento' => $occupancy >= 70 ? 'Alto' : ($occupancy >= 35 ? 'Medio' : 'Bajo'),
            ];
        })->sortByDesc('ingresos')->take(8)->values();

        $limpieza = [
            'atendidas' => $habitaciones->where('limpieza_estado', 'limpia')->count(),
            'pendientes' => $habitaciones->whereIn('limpieza_estado', ['pendiente', 'atencion'])->count(),
        ];
        $mantenimiento = ['abiertas' => 0, 'resueltas' => 0];

        return view('reportes', compact(
            'from', 'to', 'period', 'days', 'habitaciones', 'totalHabitaciones', 'ocupadas',
            'ocupacion', 'reservas', 'pagos', 'reservasPorEstado', 'ingresos', 'metodosPago',
            'basePagos', 'limpieza', 'mantenimiento', 'rendimiento', 'movimientosCaja'
        ));
    }

    private function period(Request $request): array
    {
        $period = $request->input('periodo', 'mes');
        $today = now()->startOfDay();

        if ($period === 'personalizado' && $request->filled(['desde', 'hasta'])) {
            return [Carbon::parse($request->input('desde')), Carbon::parse($request->input('hasta')), $period];
        }

        return match ($period) {
            'anio' => [$today->copy()->startOfYear(), $today->copy()->endOfYear(), $period],
            '7_dias' => [$today->copy()->subDays(6), $today->copy(), $period],
            '30_dias' => [$today->copy()->subDays(29), $today->copy(), $period],
            default => [$today->copy()->startOfMonth(), $today->copy()->endOfMonth(), 'mes'],
        };
    }
}
