<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('huespedes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->nullable();
            $table->string('tipo_documento', 30);
            $table->string('numero_documento', 30)->unique();
            $table->string('telefono', 30)->nullable();
            $table->foreignId('habitacion_id')->nullable()->constrained('habitaciones')->nullOnDelete();
            $table->enum('estado', ['alojado', 'reserva', 'inactivo'])->default('inactivo');
            $table->date('fecha_registro');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('huespedes');
    }
};