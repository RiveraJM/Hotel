<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Mantenimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MantenimientoController extends Controller
{
    public function index(Request $request): View
    {
        $mantenimientos = Mantenimiento::with('habitacion')
            ->when($request->filled('buscar'), function ($query) use ($request) {
                $term = $request->input('buscar');
                $query->where(function ($nested) use ($term) {
                    $nested->where('codigo', 'like', "%{$term}%")
                        ->orWhere('titulo', 'like', "%{$term}%")
                        ->orWhere('responsable', 'like', "%{$term}%")
                        ->orWhereHas('habitacion', fn ($room) => $room->where('numero', 'like', "%{$term}%"));
                });
            })
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->input('estado')))
            ->when($request->filled('prioridad'), fn ($query) => $query->where('prioridad', $request->input('prioridad')))
            ->when($request->filled('tipo'), fn ($query) => $query->where('tipo', $request->input('tipo')))
            ->latest()
            ->get();

        $habitaciones = Habitacion::orderBy('numero')->get();
        $resumen = [
            'pendiente' => $mantenimientos->where('estado', 'pendiente')->count(),
            'proceso' => $mantenimientos->where('estado', 'en_proceso')->count(),
            'completado' => $mantenimientos->where('estado', 'completado')->count(),
            'urgentes' => $mantenimientos->whereIn('prioridad', ['alta', 'urgente'])->where('estado', '!=', 'completado')->count(),
            'alta' => $mantenimientos->where('prioridad', 'alta')->count(),
            'media' => $mantenimientos->where('prioridad', 'media')->count(),
            'baja' => $mantenimientos->where('prioridad', 'baja')->count(),
        ];

        return view('mantenimiento', compact('mantenimientos', 'habitaciones', 'resumen'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        $validated = $this->toDatabaseData($validated);
        Mantenimiento::create($validated);

        return to_route('mantenimiento.index')->with('success', 'Mantenimiento registrado correctamente.');
    }

    public function update(Request $request, Mantenimiento $mantenimiento): RedirectResponse
    {
        $validated = $this->toDatabaseData($this->validateData($request));
        if ($validated['estado'] === 'completado') {
            $validated['fecha_fin'] = $mantenimiento->fecha_fin ?? now();
        } else {
            $validated['fecha_fin'] = null;
        }
        $mantenimiento->update($validated);

        return to_route('mantenimiento.index')->with('success', 'Mantenimiento actualizado correctamente.');
    }

    public function destroy(Mantenimiento $mantenimiento): RedirectResponse
    {
        $mantenimiento->delete();

        return to_route('mantenimiento.index')->with('success', 'Mantenimiento eliminado correctamente.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'incidencia' => ['required', 'string', 'max:150'],
            'descripcion' => ['nullable', 'string', 'max:2000'],
            'habitacion_id' => ['nullable', 'exists:habitaciones,id'],
            'tipo' => ['required', Rule::in(['preventivo', 'correctivo', 'emergencia'])],
            'prioridad' => ['required', Rule::in(['alta', 'media', 'baja', 'urgente'])],
            'responsable' => ['nullable', 'string', 'max:120'],
            'estado' => ['required', Rule::in(['pendiente', 'en_proceso', 'completado', 'cancelado'])],
            'fecha_programada' => ['nullable', 'date'],
        ]);
    }

    private function toDatabaseData(array $data): array
    {
        return [
            'habitacion_id' => $data['habitacion_id'] ?? null,
            'usuario_id' => auth()->id(),
            'titulo' => $data['incidencia'],
            'descripcion' => $data['descripcion'] ?? '',
            'tipo' => $data['tipo'],
            'prioridad' => $data['prioridad'],
            'estado' => $data['estado'],
            'fecha_reporte' => now(),
            'fecha_inicio' => $data['estado'] === 'en_proceso' ? now() : null,
            'fecha_fin' => $data['estado'] === 'completado' ? now() : null,
        ];
    }
}
