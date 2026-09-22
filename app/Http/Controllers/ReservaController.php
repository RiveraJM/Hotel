<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\Huesped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $reservasBase = Reserva::with(['huesped', 'habitacion'])
            ->orderByDesc('fecha_entrada')
            ->get();

        $habitacionesSinReserva = Habitacion::where('estado', 'reservada')
            ->whereDoesntHave('reservas')
            ->get();

        foreach ($habitacionesSinReserva as $habitacion) {
            $reservaPendiente = new Reserva([
                'codigo' => 'HAB-' . $habitacion->numero,
                'estado' => 'pendiente',
                'cantidad_huespedes' => 0,
            ]);
            $reservaPendiente->setRelation('habitacion', $habitacion);
            $reservaPendiente->setRelation('huesped', null);
            $reservasBase->push($reservaPendiente);
        }

        $reservas = Reserva::with(['huesped', 'habitacion'])
            ->when($request->filled('piso'), function ($query) use ($request) {
                $query->whereHas('habitacion', function ($query) use ($request) {
                    $query->where('piso', $request->integer('piso'));
                });
            })
            ->orderByDesc('fecha_entrada')
            ->get();

        foreach ($habitacionesSinReserva as $habitacion) {
            if ($request->filled('piso') && (int) $habitacion->piso !== $request->integer('piso')) {
                continue;
            }

            $reservaPendiente = new Reserva([
                'codigo' => 'HAB-' . $habitacion->numero,
                'estado' => 'pendiente',
                'cantidad_huespedes' => 0,
            ]);
            $reservaPendiente->setRelation('habitacion', $habitacion);
            $reservaPendiente->setRelation('huesped', null);
            $reservas->push($reservaPendiente);
        }

        $habitacionesReservadas = Habitacion::where('estado', 'reservada')
            ->when($request->filled('piso'), fn ($query) => $query->where('piso', $request->integer('piso')))
            ->orderBy('numero')
            ->get();

        $habitaciones = Habitacion::orderBy('piso')->orderBy('numero')->get();
        $pisos = Habitacion::select('piso')->distinct()->orderBy('piso')->pluck('piso');
        $pisoSeleccionado = $request->integer('piso');

        $totalReservas = $reservasBase->count();

        $confirmadas = $reservasBase
            ->where('estado', 'confirmada')
            ->count();

        $pendientes = $reservasBase
            ->where('estado', 'pendiente')
            ->count();

        $canceladas = $reservasBase
            ->where('estado', 'cancelada')
            ->count();

        return view('reservas', compact(
            'reservas',
            'habitaciones',
            'totalReservas',
            'confirmadas',
            'pendientes',
            'canceladas',
            'habitacionesReservadas',
            'pisos',
            'pisoSeleccionado'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULARIO NUEVA RESERVA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $huespedes = Huesped::orderBy('nombre')->get();

        $habitaciones = Habitacion::where('estado', 'libre')
            ->orderBy('piso')
            ->orderBy('numero')
            ->get();

        $habitacionesReservadas = Habitacion::where('estado', 'reservada')
            ->orderBy('piso')
            ->orderBy('numero')
            ->get();

        return view('reservas-create', compact(
            'huespedes',
            'habitaciones',
            'habitacionesReservadas'
        ));
    }

    public function edit(Reserva $reserva)
    {
        $huespedes = Huesped::orderBy('nombre')->get();
        $habitaciones = Habitacion::orderBy('piso')->orderBy('numero')->get();
        $habitacionesReservadas = Habitacion::where('estado', 'reservada')->orderBy('piso')->orderBy('numero')->get();

        return view('reservas-create', compact('huespedes', 'habitaciones', 'habitacionesReservadas', 'reserva'));
    }

    public function assignGuest(Habitacion $habitacion)
    {
        $huespedes = Huesped::orderBy('nombre')->get();
        $habitaciones = collect([$habitacion]);
        $habitacionesReservadas = Habitacion::where('estado', 'reservada')->orderBy('piso')->orderBy('numero')->get();

        return view('reservas-create', compact('huespedes', 'habitaciones', 'habitacionesReservadas', 'habitacion'));
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR RESERVA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'huesped_id' => ['required', 'exists:huespedes,id'],
            'habitacion_id' => ['required', 'exists:habitaciones,id'],
            'fecha_entrada' => ['required', 'date'],
            'fecha_salida' => ['required', 'date', 'after:fecha_entrada'],
            'cantidad_huespedes' => ['required', 'integer', 'min:1', 'max:20'],
            'estado' => ['required', 'in:confirmada,pendiente,cancelada'],
        ]);

        DB::transaction(function () use ($validated) {
            $habitacion = Habitacion::lockForUpdate()->findOrFail($validated['habitacion_id']);

            if ($habitacion->estado !== 'libre') {
                abort(422, 'La habitación seleccionada ya no está libre.');
            }

            $validated['codigo'] = 'RES-' . now()->format('YmdHis') . '-' . random_int(10, 99);
            Reserva::create($validated);
            $habitacion->update(['estado' => 'reservada']);
        });

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva registrada correctamente.');
    }

    public function update(Request $request, Reserva $reserva)
    {
        $validated = $request->validate([
            'huesped_id' => ['required', 'exists:huespedes,id'],
            'habitacion_id' => ['required', 'exists:habitaciones,id'],
            'fecha_entrada' => ['required', 'date'],
            'fecha_salida' => ['required', 'date', 'after:fecha_entrada'],
            'cantidad_huespedes' => ['required', 'integer', 'min:1', 'max:20'],
            'estado' => ['required', 'in:confirmada,pendiente,cancelada'],
        ]);

        $reserva->update($validated);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente.');
    }

    public function storeAssignedGuest(Request $request, Habitacion $habitacion)
    {
        $validated = $request->validate([
            'huesped_id' => ['required', 'exists:huespedes,id'],
            'fecha_entrada' => ['required', 'date'],
            'fecha_salida' => ['required', 'date', 'after:fecha_entrada'],
            'cantidad_huespedes' => ['required', 'integer', 'min:1', 'max:20'],
            'estado' => ['required', 'in:confirmada,pendiente,cancelada'],
        ]);

        $validated['habitacion_id'] = $habitacion->id;
        $validated['codigo'] = 'RES-' . now()->format('YmdHis') . '-' . random_int(10, 99);
        Reserva::create($validated);

        return redirect()->route('reservas.index')->with('success', 'Huésped asignado a la reserva correctamente.');
    }
}