<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ediciones', function (Blueprint $table) {
            $table->dateTime('fecha_apertura')->change();
            $table->dateTime('fecha_cierre')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ediciones', function (Blueprint $table) {
            $table->date('fecha_apertura')->change();
            $table->date('fecha_cierre')->change();
        });
    }
};
