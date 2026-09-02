<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración.
     */
    public function up(): void
    {
        Schema::create('habitaciones', function (Blueprint $table) {

            $table->id();

            // Número de habitación
            $table->string('numero', 10)->unique();

            // Piso donde se encuentra
            $table->unsignedTinyInteger('piso');

            // Tipo de habitación
            $table->string('tipo', 50);

            // Capacidad máxima
            $table->unsignedTinyInteger('capacidad')->default(1);

            // Precio por noche
            $table->decimal('precio', 10, 2);

            // Estado actual de la habitación
            $table->enum('estado', [
                'libre',
                'reservada',
                'ocupada',
                'mantenimiento'
            ])->default('libre');

            // Descripción opcional
            $table->text('descripcion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};