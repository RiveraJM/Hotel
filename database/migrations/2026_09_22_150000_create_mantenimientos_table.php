<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mantenimientos')) {
            return;
        }

        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->string('incidencia', 180);
            $table->text('descripcion')->nullable();
            $table->foreignId('habitacion_id')->nullable()->constrained('habitaciones')->nullOnDelete();
            $table->enum('tipo', ['electrico', 'fontaneria', 'climatizacion', 'infraestructura', 'equipamiento']);
            $table->enum('prioridad', ['alta', 'media', 'baja'])->default('media');
            $table->string('responsable', 120)->nullable();
            $table->enum('estado', ['pendiente', 'proceso', 'completado'])->default('pendiente');
            $table->date('fecha_programada')->nullable();
            $table->dateTime('fecha_completada')->nullable();
            $table->timestamps();
            $table->index(['estado', 'prioridad']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
