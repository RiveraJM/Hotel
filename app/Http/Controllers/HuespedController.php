<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Huesped;
use Illuminate\Http\Request;

class HuespedController extends Controller
{
    public function index(Request $request)
    {
        $query = Huesped::with('habitacion')
            ->when($request->filled('buscar'), function ($query) use ($request) {
                $buscar = (string) $request->string('buscar')->trim();

                $query->where(function ($query) use ($buscar) {
                    $query->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('numero_documento', 'like', "%{$buscar}%")
                        ->orWhere('telefono', 'like', "%{$buscar}%");
                });
            })
            ->when($request->filled('estado'), function ($query) use ($request) {
                $estado = (string) $request->string('estado');

                if ($estado === 'activo') {
                    $query->whereIn('estado', ['alojado', 'reserva']);
                    return;
                }

                $query->where('estado', $estado);
            })
            ->orderByDesc('fecha_registro')
            ->get();

        $huespedes = $query;

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

    public function create()
    {
        $habitaciones = Habitacion::orderBy('piso')
            ->orderBy('numero')
            ->get();

        return view('huespedes-create', compact('habitaciones'));
    }

    public function edit(Huesped $huesped)
    {
        $habitaciones = Habitacion::orderBy('piso')
            ->orderBy('numero')
            ->get();

        return view('huespedes-create', compact('habitaciones', 'huesped'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'tipo_documento' => ['required', 'in:DNI,Pasaporte,CE'],
            'numero_documento' => ['required', 'string', 'max:30', 'unique:huespedes,numero_documento'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'habitacion_id' => ['nullable', 'exists:habitaciones,id'],
            'estado' => ['required', 'in:alojado,reserva,inactivo'],
            'fecha_registro' => ['required', 'date'],
        ]);

        Huesped::create($validated);

        return redirect()
            ->route('huespedes.index')
            ->with('success', 'Huésped registrado correctamente.');
    }

    public function update(Request $request, Huesped $huesped)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'tipo_documento' => ['required', 'in:DNI,Pasaporte,CE'],
            'numero_documento' => ['required', 'string', 'max:30', 'unique:huespedes,numero_documento,' . $huesped->id],
            'telefono' => ['nullable', 'string', 'max:30'],
            'habitacion_id' => ['nullable', 'exists:habitaciones,id'],
            'estado' => ['required', 'in:alojado,reserva,inactivo'],
            'fecha_registro' => ['required', 'date'],
        ]);

        $huesped->update($validated);

        return redirect()
            ->route('huespedes.index')
            ->with('success', 'Huésped actualizado correctamente.');
    }

    public function destroy(Huesped $huesped)
    {
        $huesped->delete();

        return redirect()
            ->route('huespedes.index')
            ->with('success', 'Huésped eliminado correctamente.');
    }
}