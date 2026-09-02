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
        'descripcion',
    ];

    protected $casts = [
        'piso' => 'integer',
        'capacidad' => 'integer',
        'precio' => 'decimal:2',
    ];

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }
}