<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->enum('limpieza_estado', ['limpia', 'pendiente', 'en_proceso', 'atencion'])
                ->default('pendiente')
                ->after('estado');
            $table->enum('limpieza_prioridad', ['normal', 'alta', 'urgente'])
                ->default('normal')
                ->after('limpieza_estado');
            $table->string('limpieza_notas', 500)->nullable()->after('limpieza_prioridad');
            $table->dateTime('limpieza_iniciada_at')->nullable()->after('limpieza_notas');
            $table->dateTime('limpieza_completada_at')->nullable()->after('limpieza_iniciada_at');
        });
    }

    public function down(): void
    {
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->dropColumn([
                'limpieza_estado',
                'limpieza_prioridad',
                'limpieza_notas',
                'limpieza_iniciada_at',
                'limpieza_completada_at',
            ]);
        });
    }
};
