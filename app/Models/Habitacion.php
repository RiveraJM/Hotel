<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habitacion extends Model
{
    protected $table = 'habitaciones';

    protected $fillable = [
        'numero',
        'piso',
        'tipo',
        'capacidad',
        'precio',
        'estado',
        'limpieza_estado',
        'limpieza_prioridad',
        'limpieza_notas',
        'limpieza_iniciada_at',
        'limpieza_completada_at',
        'descripcion',
    ];

    protected $casts = [
        'piso' => 'integer',
        'capacidad' => 'integer',
        'precio' => 'decimal:2',
        'limpieza_iniciada_at' => 'datetime',
        'limpieza_completada_at' => 'datetime',
    ];

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }
}