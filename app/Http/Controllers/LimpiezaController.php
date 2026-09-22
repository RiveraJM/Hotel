<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class LimpiezaController extends Controller
{
    public function index(): View
    {
        $habitaciones = Habitacion::query()
            ->orderBy('numero')
            ->get();

        return view('limpieza', compact('habitaciones'));
    }

    public function update(Request $request, Habitacion $habitacion): RedirectResponse
    {
        $validated = $request->validate([
            'limpieza_estado' => ['required', Rule::in(['limpia', 'pendiente', 'en_proceso', 'atencion'])],
            'limpieza_prioridad' => ['required', Rule::in(['normal', 'alta', 'urgente'])],
            'limpieza_notas' => ['nullable', 'string', 'max:500'],
        ]);

        $timestamps = match ($validated['limpieza_estado']) {
            'en_proceso' => [
                'limpieza_iniciada_at' => $habitacion->limpieza_iniciada_at ?? now(),
                'limpieza_completada_at' => null,
            ],
            'limpia' => [
                'limpieza_iniciada_at' => $habitacion->limpieza_iniciada_at ?? now(),
                'limpieza_completada_at' => now(),
            ],
            default => [
                'limpieza_iniciada_at' => null,
                'limpieza_completada_at' => null,
            ],
        };

        $habitacion->update(array_merge($validated, $timestamps));

        return to_route('limpieza.index')->with('status', "Habitación {$habitacion->numero} actualizada.");
    }
}
