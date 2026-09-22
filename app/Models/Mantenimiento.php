<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mantenimiento extends Model
{
    protected $table = 'mantenimientos';

    protected $appends = ['codigo', 'incidencia', 'responsable', 'fecha_programada', 'fecha_completada'];

    protected $fillable = ['habitacion_id', 'usuario_id', 'titulo', 'descripcion', 'tipo', 'prioridad', 'estado', 'fecha_reporte', 'fecha_inicio', 'fecha_fin', 'costo', 'observaciones'];

    protected $casts = [
        'fecha_reporte' => 'datetime',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'costo' => 'decimal:2',
    ];

    public function habitacion(): BelongsTo
    {
        return $this->belongsTo(Habitacion::class);
    }

    public function getCodigoAttribute(): string { return 'MT-' . str_pad((string) $this->id, 6, '0', STR_PAD_LEFT); }
    public function getIncidenciaAttribute(): string { return (string) $this->titulo; }
    public function getResponsableAttribute(): string { return $this->usuario_id ? 'Usuario #' . $this->usuario_id : ''; }
    public function getFechaProgramadaAttribute() { return $this->fecha_reporte; }
    public function getFechaCompletadaAttribute() { return $this->fecha_fin; }
}
