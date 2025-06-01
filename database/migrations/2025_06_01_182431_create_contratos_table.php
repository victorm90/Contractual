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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();

            // Identificación única automática
            $table->string('numero_contrato', 15)->unique()->comment('Formato: AAAAMMDD-XXX');

            // Información básica
            $table->string('nombre_cliente', 120);
            $table->text('descripcion')->nullable()->comment('Descripción breve del contrato');

            // Relaciones
            $table->foreignId('clas_legal_id')->constrained('clas_legals')->comment('Clasificación legal');
            $table->foreignId('empresa_id')->constrained('empresas')->comment('Empresa asociada');
            $table->foreignId('provincia_id')->constrained('provincias');
            $table->foreignId('municipio_id')->constrained('municipios');
            $table->foreignId('form_pago_id')->constrained('form_pagos')->comment('Forma de pago acordada');
            $table->foreignId('user_id')->constrained('users')->comment('Responsable del contrato');

            // Información de contacto
            $table->string('direccion', 200);
            $table->string('email', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('representante_legal', 100)->nullable();

            // Datos legales y financieros
            $table->string('cod_reuup', 20)->nullable()->comment('Código REUUP');
            $table->string('codigo_nit', 20)->nullable()->comment('Código NIT');
            $table->string('cta_bancaria', 30)->nullable()->comment('Cuenta bancaria');
            $table->string('sucursal_credito', 50)->nullable()->comment('Sucursal bancaria');

            // Términos del contrato
            $table->date('fecha_firmado');
            $table->date('fecha_vencimiento');
            $table->string('vigencia', 50)->comment('Ej: 1 año, 6 meses');
            $table->string('termino_pago', 50)->comment('Ej: 30 días, 2 meses');
            $table->decimal('monto_total', 15, 2)->default(0)->comment('Valor total del contrato');
            $table->string('moneda', 3)->default('CUP')->comment('CUP, USD, EUR');

            // Control y seguimiento
            $table->boolean('activo')->default(true);
            $table->string('estado', 20)->default('VIGENTE')->comment('VIGENTE, VENCIDO, CANCELADO, SUSPENDIDO');
            $table->integer('dias_renovacion_aviso')->default(30)->comment('Días de aviso para renovación');

            // Archivos y observaciones
            $table->string('archivo_path')->nullable()->comment('Ruta del contrato escaneado');
            $table->string('archivo_mime')->nullable()->comment('Tipo MIME del archivo');
            $table->text('observaciones')->nullable();

            // Auditoría
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('last_updated_by')->nullable()->constrained('users')->comment('Último usuario que modificó');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
