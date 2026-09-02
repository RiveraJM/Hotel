<?php

namespace App\Http\Controllers;

use App\Models\Huesped;

class HuespedController extends Controller
{
    public function index()
    {
        $huespedes = Huesped::with('habitacion')
            ->orderByDesc('fecha_registro')
            ->get();

        $totalHuespedes = $huespedes->count();
        $huespedesActivos = $huespedes->whereIn('estado', ['alojado', 'reserva'])->count();
        $huespedesAlojados = $huespedes->where('estado', 'alojado')->count();
        $proximasLlegadas = $huespedes->where('estado', 'reserva')->count();

        return view('huespedes', compact(
            'huespedes',
            'totalHuespedes',
            'huespedesActivos',
            'huespedesAlojados',
            'proximasLlegadas'
        ));
    }
}