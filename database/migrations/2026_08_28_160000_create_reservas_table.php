<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->foreignId('huesped_id')->constrained('huespedes')->cascadeOnDelete();
            $table->foreignId('habitacion_id')->constrained('habitaciones')->restrictOnDelete();
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->unsignedTinyInteger('cantidad_huespedes')->default(1);
            $table->enum('estado', ['confirmada', 'pendiente', 'cancelada'])->default('pendiente');
            $table->timestamps();

            $table->index(['fecha_entrada', 'fecha_salida']);
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};