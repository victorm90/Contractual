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
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique()->comment('Código único del municipio');
            $table->string('nombre')->comment('Nombre del municipio');
            $table->string('codigo_provincia', 2)->comment('Código de provincia relacionada');
            $table->foreignId('provincia_id')->constrained('provincias')->comment('Relación con provincia');
            $table->timestamps();

            // Índices
            $table->index('nombre');
            $table->index('codigo_provincia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipios');
    }
};
