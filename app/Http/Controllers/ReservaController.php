<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Reserva;
use App\Models\Huesped;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['huesped', 'habitacion'])
            ->orderByDesc('fecha_entrada')
            ->get();

        $habitaciones = Habitacion::orderBy('piso')
            ->orderBy('numero')
            ->get();

        $totalReservas = $reservas->count();

        $confirmadas = $reservas
            ->where('estado', 'confirmada')
            ->count();

        $pendientes = $reservas
            ->where('estado', 'pendiente')
            ->count();

        $canceladas = $reservas
            ->where('estado', 'cancelada')
            ->count();

        return view('reservas', compact(
            'reservas',
            'habitaciones',
            'totalReservas',
            'confirmadas',
            'pendientes',
            'canceladas'
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

        return view('reservas-create', compact(
            'huespedes',
            'habitaciones'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | GUARDAR RESERVA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        // Aquí conectaremos la validación y guardado
        // cuando hagamos el formulario.

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva registrada correctamente.');
    }
}