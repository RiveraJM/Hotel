<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dateTime('checked_out_at')->nullable()->after('estado');
            $table->string('payment_method', 30)->nullable()->after('checked_out_at');
            $table->string('payment_status', 20)->default('pendiente')->after('payment_method');
            $table->text('checkout_notes')->nullable()->after('payment_status');
            $table->json('consumos')->nullable()->after('checkout_notes');
            $table->decimal('descuento', 10, 2)->default(0)->after('consumos');
            $table->decimal('total', 10, 2)->nullable()->after('descuento');
        });
    }

    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn([
                'checked_out_at',
                'payment_method',
                'payment_status',
                'checkout_notes',
                'consumos',
                'descuento',
                'total',
            ]);
        });
    }
};
