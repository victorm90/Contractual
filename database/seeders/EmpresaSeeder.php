<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $empresas = [
            [
                'IdEmpresa' => '0',
                'NEmpresa' => 'Privada',
                'Organismo' => '0',
                'Priorizada' => false
            ],
            [
                'IdEmpresa' => '00131',
                'NEmpresa' => 'Ministerio de la Agricultura',
                'Organismo' => '131',
                'Priorizada' => false
            ],
            [
                'IdEmpresa' => '00258',
                'NEmpresa' => 'BANCO DE CREDITO Y COMERCIO',
                'Organismo' => '258',
                'Priorizada' => false
            ],
            [
                'IdEmpresa' => '00502',
                'NEmpresa' => 'Unión de Jóvenes Comunistas',
                'Organismo' => '502',
                'Priorizada' => false
            ],
            [
                'IdEmpresa' => '00504',
                'NEmpresa' => 'Central De Trabajadores De Cuba',
                'Organismo' => '504',
                'Priorizada' => false
            ],
        ];

        foreach ($empresas as $empresa) {
            Empresa::create($empresa);
        }
    }
}
