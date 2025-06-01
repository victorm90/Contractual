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
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')->nullable()->constrained('contratos')->onDelete('cascade')->comment('Referencia al contrato');
            $table->string('CIdentidad', 20)->nullable()->comment('Carnet de identidad');
            $table->string('NRepresentante', 100)->comment('Nombre completo del representante');
            $table->boolean('Activo')->default(true)->comment('Estado activo/inactivo');
            $table->string('CargoRepresentante', 100)->comment('Cargo del representante');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->comment('Usuario asociado');
            $table->timestamps();
            $table->softDeletes();

            $table->index('CIdentidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representantes');
    }
};
