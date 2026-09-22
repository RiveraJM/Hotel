<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Reserva;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    /**
     * Mostrar todas las habitaciones.
     */
    public function index()
    {
        $habitaciones = Habitacion::with(['reservas' => fn ($query) => $query
                ->whereIn('payment_status', ['pagado', 'pendiente'])
                ->latest('created_at')])
            ->orderBy('piso')
            ->orderBy('numero')
            ->get();

        return view('habitaciones', compact('habitaciones'));
    }

    /**
     * Mostrar el detalle de una habitación.
     */
    public function show(Habitacion $habitacion)
    {
        $imagenes = [
            'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=900&q=80',
        ];

        return view('habitacion-detalle', compact('habitacion', 'imagenes'));
    }

    /**
     * Actualizar el estado de una habitación.
     */
    public function updateStatus(Request $request, Habitacion $habitacion)
    {
        $validated = $request->validate([
            'estado' => ['required', 'in:libre,reservada,ocupada,mantenimiento'],
        ]);

        $habitacion->update([
            'estado' => $validated['estado'],
        ]);

        if (str_contains((string) $request->headers->get('referer'), '/reservas')) {
            return back()->with('success', 'Estado de la habitación actualizado correctamente.');
        }

        return redirect()
            ->route('habitaciones.show', $habitacion)
            ->with('success', 'Estado actualizado correctamente.');
    }

    /**
     * Guardar una nueva habitación.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => ['required', 'string', 'max:10', 'unique:habitaciones,numero'],
            'piso' => ['required', 'integer', 'min:1', 'max:20'],
            'tipo' => ['required', 'string', 'max:50'],
            'capacidad' => ['required', 'integer', 'min:1', 'max:20'],
            'precio' => ['required', 'numeric', 'min:0'],
            'estado' => ['required', 'in:libre,reservada,ocupada,mantenimiento'],
            'descripcion' => ['nullable', 'string', 'max:500'],
        ]);

        Habitacion::create($validated);

        return redirect()
            ->route('habitaciones.index')
            ->with('success', 'Habitación registrada correctamente.');
    }
}