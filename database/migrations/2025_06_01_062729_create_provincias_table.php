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
        Schema::create('provincias', function (Blueprint $table) {
           $table->id();
            $table->string('codigo', 2)->nullable()->comment('Código de provincia (ej: P, A, L)');
            $table->string('nombre')->unique()->comment('Nombre completo de la provincia');
            $table->string('abreviatura', 1)->nullable()->comment('Abreviatura de una letra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provincias');
    }
};
