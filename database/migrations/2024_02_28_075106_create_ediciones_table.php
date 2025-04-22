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
        Schema::create('ediciones', function (Blueprint $table) {
            $table->id();
            $table->string('curso_escolar', 10);
            $table->date('fecha_celebracion');
            $table->date('fecha_apertura');
            $table->date('fecha_cierre');
            $table->string('css_file', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ediciones');
    }
};
