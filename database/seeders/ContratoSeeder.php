<?php

namespace Database\Seeders;

use App\Models\Contrato;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::first() ?? User::factory()->create();
        
        $contratos = [
            [
                'nombre_cliente' => 'Empresa de Tecnología ABC',
                'descripcion' => 'Servicios de desarrollo de software',
                'clas_legal_id' => 1, // Persona Jurídica Cubana
                'empresa_id' => 1, // Privada
                'provincia_id' => 1, // Ejemplo
                'municipio_id' => 1, // Ejemplo
                'form_pago_id' => 1, // Transferencia
                'user_id' => $user->id,
                'direccion' => 'Calle 42 #1234, Vedado',
                'email' => 'contacto@empresaabc.cu',
                'telefono' => '+53712345678',
                'representante_legal' => 'Juan Pérez López',
                'cod_reuup' => 'A12345',
                'codigo_nit' => 'N67890',
                'cta_bancaria' => '1234567890123456',
                'sucursal_credito' => 'Banco Metropolitano - Sucursal Centro',
                'fecha_firmado' => now()->subMonths(3),
                'fecha_vencimiento' => now()->addYear(),
                'vigencia' => '1 año',
                'termino_pago' => '30 días',
                'monto_total' => 50000.00,
                'moneda' => 'CUP',
                'activo' => true,
                'estado' => 'VIGENTE',
                'dias_renovacion_aviso' => 60,
                'observaciones' => 'Contrato de servicios tecnológicos con cláusula de confidencialidad',
                'last_updated_by' => $user->id
            ],
            [
                'nombre_cliente' => 'Ministerio de la Agricultura',
                'descripcion' => 'Suministro de equipos agrícolas',
                'clas_legal_id' => 1, // Persona Jurídica Cubana
                'empresa_id' => 2, // Ministerio de la Agricultura
                'provincia_id' => 2,
                'municipio_id' => 5,
                'form_pago_id' => 3, // Cheque
                'user_id' => $user->id,
                'direccion' => 'Calle 5ta, Miramar',
                'email' => 'contrataciones@minag.gob.cu',
                'telefono' => '+53787654321',
                'representante_legal' => 'Ana Martínez Rodríguez',
                'cod_reuup' => 'B54321',
                'codigo_nit' => 'N09876',
                'cta_bancaria' => '9876543210987654',
                'sucursal_credito' => 'BANDEC - Sucursal Plaza',
                'fecha_firmado' => now()->subMonths(6),
                'fecha_vencimiento' => now()->addMonths(6),
                'vigencia' => '1 año',
                'termino_pago' => '45 días',
                'monto_total' => 120000.00,
                'moneda' => 'CUP',
                'activo' => true,
                'estado' => 'VIGENTE',
                'dias_renovacion_aviso' => 90,
                'observaciones' => 'Incluye mantenimiento por 6 meses',
                'last_updated_by' => $user->id
            ],
            [
                'nombre_cliente' => 'Hotel Internacional',
                'descripcion' => 'Mantenimiento de instalaciones',
                'clas_legal_id' => 3, // Persona Natural Extranjera
                'empresa_id' => 1, // Privada
                'provincia_id' => 3,
                'municipio_id' => 8,
                'form_pago_id' => 2, // Efectivo
                'user_id' => $user->id,
                'direccion' => 'Avenida 1ra #100, Varadero',
                'email' => 'gerencia@hotelinternacional.com',
                'telefono' => '+53451234567',
                'representante_legal' => 'Robert Johnson',
                'cod_reuup' => 'C67890',
                'codigo_nit' => 'N54321',
                'cta_bancaria' => '1122334455667788',
                'sucursal_credito' => 'Banco de Crédito y Comercio - Sucursal Varadero',
                'fecha_firmado' => now()->subYear(),
                'fecha_vencimiento' => now()->addMonths(2),
                'vigencia' => '18 meses',
                'termino_pago' => '15 días',
                'monto_total' => 75000.00,
                'moneda' => 'USD',
                'activo' => true,
                'estado' => 'POR VENCER',
                'dias_renovacion_aviso' => 30,
                'observaciones' => 'Renovar antes de vencimiento para continuidad de servicios',
                'last_updated_by' => $user->id
            ]
        ];

        foreach ($contratos as $contrato) {
            Contrato::create($contrato);
        }
    }
}
