<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caja extends Model
{
    protected $table = 'cajas';

        protected $fillable = ['usuario_apertura_id', 'usuario_cierre_id', 'fecha_apertura', 'fecha_cierre', 'monto_inicial', 'monto_final', 'total_ingresos', 'total_egresos', 'diferencia', 'estado', 'observaciones'];

    protected $casts = [
        'monto_inicial' => 'decimal:2',
        'monto_final' => 'decimal:2',
        'total_ingresos' => 'decimal:2',
        'total_egresos' => 'decimal:2',
        'diferencia' => 'decimal:2',
        'fecha_apertura' => 'datetime',
        'fecha_cierre' => 'datetime',
    ];

    public function movimientos(): HasMany
    {
        return $this->hasMany(MovimientoCaja::class);
    }

    public function getAbiertaAttribute(): bool
    {
        return $this->estado === 'abierta' && is_null($this->fecha_cierre);
    }
}
