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
        Schema::create('clas_legals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->unique()->comment('Nombre de la clasificación legal');
            $table->integer('position')->default(0)->comment('Posición para ordenamiento');
            $table->boolean('is_active')->default(true)->comment('Estado activo/inactivo');
            $table->timestamps();
            $table->softDeletes()->comment('Fecha de eliminación suave');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clas_legals');
    }
};
