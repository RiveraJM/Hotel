<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Huesped;
use App\Models\Reserva;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckinController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::whereIn('estado', ['libre', 'reservada'])
            ->orderBy('piso')
            ->orderBy('numero')
            ->get();

        return view('checkin', compact('habitaciones'));
    }

    public function search(Request $request): JsonResponse
    {
        $term = trim((string) $request->input('buscar'));

        if ($term === '') {
            return response()->json(['message' => 'Ingresa un documento, nombre o código de reserva.'], 422);
        }

        $reservas = Reserva::with(['huesped', 'habitacion'])
            ->where(function ($query) use ($term) {
                $query->where('codigo', 'like', "%{$term}%")
                    ->orWhereHas('huesped', function ($query) use ($term) {
                        $query->where('nombre', 'like', "%{$term}%")
                            ->orWhere('numero_documento', 'like', "%{$term}%")
                            ->orWhere('telefono', 'like', "%{$term}%")
                            ->orWhere('email', 'like', "%{$term}%");
                    });
            })
            ->whereIn('estado', ['confirmada', 'pendiente'])
            ->whereDate('fecha_salida', '>=', now()->toDateString())
            ->orderBy('fecha_entrada')
            ->get();

        if ($reservas->isEmpty()) {
            return response()->json(['message' => 'No encontramos una reserva o huésped con ese dato.'], 404);
        }

        $reserva = $reservas->first();
        $huesped = $reserva->huesped;
        $historial = $huesped ? $huesped->reservas()->where('id', '<>', $reserva->id)->latest('fecha_salida')->get() : collect();
        $totalEstancias = $historial->where('estado', 'confirmada')->count();
        $categoria = match (true) {
            $totalEstancias >= 5 => 'Huésped frecuente',
            $totalEstancias > 0 => 'Huésped recurrente',
            default => 'Primera estancia',
        };
        $descuento = $totalEstancias >= 5 ? 10 : 0;

        return response()->json([
            'reserva' => [
                'id' => $reserva->id,
                'codigo' => $reserva->codigo,
                'fecha_entrada' => $reserva->fecha_entrada->format('Y-m-d'),
                'fecha_salida' => $reserva->fecha_salida->format('Y-m-d'),
                'cantidad_huespedes' => $reserva->cantidad_huespedes,
                'habitacion_id' => $reserva->habitacion_id,
                'habitacion' => $reserva->habitacion?->numero,
                'estado' => $reserva->estado,
            ],
            'huesped' => $huesped ? [
                'id' => $huesped->id,
                'nombre' => $huesped->nombre,
                'tipo_documento' => $huesped->tipo_documento,
                'numero_documento' => $huesped->numero_documento,
                'telefono' => $huesped->telefono,
                'email' => $huesped->email,
            ] : null,
            'historial' => [
                'total' => $totalEstancias,
                'ultima_estancia' => $historial->first()?->fecha_salida?->format('d/m/Y'),
                'categoria' => $categoria,
                'descuento' => $descuento,
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'reserva_id' => ['nullable', 'exists:reservas,id'],
            'huesped_id' => ['nullable', 'exists:huespedes,id'],
            'habitacion_id' => ['required', 'exists:habitaciones,id'],
            'fecha_entrada' => ['required', 'date'],
            'fecha_salida' => ['required', 'date', 'after:fecha_entrada'],
            'cantidad_huespedes' => ['required', 'integer', 'min:1', 'max:20'],
            'codigo_reserva' => ['nullable', 'string', 'max:30'],
            'nuevo_huesped' => ['nullable', 'array'],
            'nuevo_huesped.tipo_documento' => ['required_with:nuevo_huesped', Rule::in(['DNI', 'PASAPORTE', 'CE'])],
            'nuevo_huesped.numero_documento' => ['required_with:nuevo_huesped', 'string', 'max:30'],
            'nuevo_huesped.nombre' => ['required_with:nuevo_huesped', 'string', 'max:255'],
            'nuevo_huesped.telefono' => ['nullable', 'string', 'max:30'],
            'nuevo_huesped.email' => ['nullable', 'email', 'max:255'],
        ]);

        $resultado = DB::transaction(function () use ($validated) {
            $habitacion = Habitacion::lockForUpdate()->findOrFail($validated['habitacion_id']);
            if (!in_array($habitacion->estado, ['libre', 'reservada'], true)) {
                abort(422, 'La habitación seleccionada no está disponible para check-in.');
            }

            $huesped = !empty($validated['huesped_id'])
                ? Huesped::findOrFail($validated['huesped_id'])
                : Huesped::create([
                    ...$validated['nuevo_huesped'],
                    'habitacion_id' => $habitacion->id,
                    'estado' => 'alojado',
                    'fecha_registro' => now()->toDateString(),
                ]);

            $reserva = !empty($validated['reserva_id'])
                ? Reserva::lockForUpdate()->findOrFail($validated['reserva_id'])
                : Reserva::create([
                    'codigo' => $validated['codigo_reserva'] ?: 'RES-' . now()->format('YmdHis') . '-' . random_int(10, 99),
                    'huesped_id' => $huesped->id,
                    'habitacion_id' => $habitacion->id,
                    'fecha_entrada' => $validated['fecha_entrada'],
                    'fecha_salida' => $validated['fecha_salida'],
                    'cantidad_huespedes' => $validated['cantidad_huespedes'],
                    'estado' => 'confirmada',
                ]);

            if ($reserva->habitacion_id !== $habitacion->id || ($reserva->huesped_id && $reserva->huesped_id !== $huesped->id)) {
                abort(422, 'La reserva no corresponde al huésped o habitación seleccionados.');
            }

            $reserva->update(['estado' => 'confirmada']);
            $habitacion->update(['estado' => 'ocupada']);
            $huesped->update(['habitacion_id' => $habitacion->id, 'estado' => 'alojado']);

            return compact('reserva', 'huesped', 'habitacion');
        });

        return response()->json([
            'message' => 'Check-in registrado correctamente.',
            'redirect' => route('checkin.index'),
            'codigo' => $resultado['reserva']->codigo,
            'huesped' => $resultado['huesped']->nombre,
            'habitacion' => $resultado['habitacion']->numero,
        ], 201);
    }
}
