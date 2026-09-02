<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'codigo',
        'huesped_id',
        'habitacion_id',
        'fecha_entrada',
        'fecha_salida',
        'cantidad_huespedes',
        'estado',
    ];

    protected $casts = [
        'fecha_entrada' => 'date',
        'fecha_salida' => 'date',
        'cantidad_huespedes' => 'integer',
    ];

    public function huesped(): BelongsTo
    {
        return $this->belongsTo(Huesped::class);
    }

    public function habitacion(): BelongsTo
    {
        return $this->belongsTo(Habitacion::class);
    }
}