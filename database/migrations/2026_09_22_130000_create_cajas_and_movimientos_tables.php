<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('cajas') || Schema::hasTable('movimientos_caja')) {
            return;
        }

        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('saldo_inicial', 12, 2)->default(0);
            $table->dateTime('abierta_at');
            $table->dateTime('cerrada_at')->nullable();
            $table->decimal('efectivo_contado', 12, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->index(['cerrada_at', 'abierta_at']);
        });

        Schema::create('movimientos_caja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caja_id')->constrained('cajas')->cascadeOnDelete();
            $table->foreignId('reserva_id')->nullable()->constrained('reservas')->nullOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->enum('metodo', ['efectivo', 'tarjeta', 'transferencia', 'yape', 'plin', 'otro'])->default('efectivo');
            $table->string('concepto', 180);
            $table->decimal('monto', 12, 2);
            $table->enum('estado', ['registrado', 'anulado'])->default('registrado');
            $table->dateTime('movimiento_at');
            $table->timestamps();
            $table->index(['caja_id', 'movimiento_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos_caja');
        Schema::dropIfExists('cajas');
    }
};
