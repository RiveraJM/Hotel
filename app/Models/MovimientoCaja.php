<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientoCaja extends Model
{
    protected $table = 'movimientos_caja';

        protected $fillable = ['caja_id', 'pago_id', 'tipo', 'concepto', 'monto', 'metodo_pago_id', 'fecha', 'usuario_id', 'observaciones'];

    protected $casts = [
        'monto' => 'decimal:2',
            'fecha' => 'datetime',
    ];

    public function caja(): BelongsTo
    {
        return $this->belongsTo(Caja::class);
    }

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class);
    }
}
