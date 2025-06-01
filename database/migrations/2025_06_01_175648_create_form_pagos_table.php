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
        Schema::create('form_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique()->comment('Nombre de la forma de pago');
            $table->string('descripcion', 255)->nullable()->comment('Descripción detallada');
            $table->boolean('requiere_referencia')->default(false)->comment('Requiere número de referencia/cheque?');
            $table->boolean('requiere_banco')->default(false)->comment('Requiere especificar banco?');
            $table->integer('dias_clearing')->default(0)->comment('Días para clearing del pago');
            $table->boolean('activo')->default(true)->comment('Estado activo/inactivo');
            $table->text('observaciones')->nullable()->comment('Observaciones adicionales');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pagos');
    }
};
