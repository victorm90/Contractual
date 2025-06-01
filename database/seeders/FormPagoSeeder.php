<?php

namespace Database\Seeders;

use App\Models\FormPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formasPago = [
            [
                'nombre' => 'Transferencia',
                'descripcion' => 'Pago mediante transferencia bancaria',
                'requiere_referencia' => true,
                'requiere_banco' => true,
                'dias_clearing' => 1,
                'activo' => true,
                'observaciones' => 'Requiere comprobante de transferencia'
            ],
            [
                'nombre' => 'Cheque',
                'descripcion' => 'Pago mediante cheque bancario',
                'requiere_referencia' => true,
                'requiere_banco' => true,
                'dias_clearing' => 3,
                'activo' => true,
                'observaciones' => 'Cheques con fecha posterior no aceptados'
            ],
            [
                'nombre' => 'Efectivo',
                'descripcion' => 'Pago en moneda física',
                'requiere_referencia' => false,
                'requiere_banco' => false,
                'dias_clearing' => 0,
                'activo' => true,
                'observaciones' => 'Aceptar solo en moneda nacional'
            ],
            [
                'nombre' => 'Tarjeta de Crédito',
                'descripcion' => 'Pago con tarjeta de crédito/débito',
                'requiere_referencia' => true,
                'requiere_banco' => false,
                'dias_clearing' => 2,
                'activo' => true,
                'observaciones' => 'Comisión del 3% aplica'
            ],
            [
                'nombre' => 'Crédito Comercial',
                'descripcion' => 'Pago a crédito según acuerdo comercial',
                'requiere_referencia' => false,
                'requiere_banco' => false,
                'dias_clearing' => 30,
                'activo' => true,
                'observaciones' => 'Requiere aprobación previa'
            ]
        ];

        foreach ($formasPago as $forma) {
            FormPago::create($forma);
        }
    }
}
