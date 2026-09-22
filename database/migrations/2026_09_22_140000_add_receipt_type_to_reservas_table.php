<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('reservas', 'comprobante_tipo')) {
            Schema::table('reservas', function (Blueprint $table) {
                $table->enum('comprobante_tipo', ['ticket', 'boleta'])->nullable()->after('payment_status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('reservas', 'comprobante_tipo')) {
            Schema::table('reservas', function (Blueprint $table) {
                $table->dropColumn('comprobante_tipo');
            });
        }
    }
};
