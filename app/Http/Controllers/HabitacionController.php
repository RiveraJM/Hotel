<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;

class HabitacionController extends Controller
{
    /**
     * Mostrar todas las habitaciones.
     */
    public function index()
    {
        $habitaciones = Habitacion::orderBy('piso')
            ->orderBy('numero')
            ->get();

        return view('habitaciones', compact('habitaciones'));
    }
}