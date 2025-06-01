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
        Schema::create('empresas', function (Blueprint $table) {

            $table->id();
            $table->string('IdEmpresa', 10)->nullable()->comment('Código único de la empresa');
            $table->string('NEmpresa', 100)->nullable()->comment('Nombre de la empresa');
            $table->string('Organismo', 10)->nullable()->comment('Nombre del organismo');
            $table->boolean('Priorizada')->default(false)->comment('Indica si la empresa está priorizada');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
