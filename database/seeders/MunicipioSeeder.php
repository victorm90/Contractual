<?php

namespace Database\Seeders;

use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $municipios = [
            ['codigo' => '3501', 'nombre' => 'El Salvador', 'codigo_provincia' => '15'],
            ['codigo' => '3502', 'nombre' => 'Manuel Tames', 'codigo_provincia' => '15'],
            ['codigo' => '3503', 'nombre' => 'Yateras', 'codigo_provincia' => '15'],
            ['codigo' => '3504', 'nombre' => 'Baracoa', 'codigo_provincia' => '15'],
            ['codigo' => '3505', 'nombre' => 'Maisi', 'codigo_provincia' => '15'],
            ['codigo' => '3506', 'nombre' => 'Imias', 'codigo_provincia' => '15'],
            ['codigo' => '3507', 'nombre' => 'San Antonio del Sur', 'codigo_provincia' => '15'],
            ['codigo' => '3508', 'nombre' => 'Caimanera', 'codigo_provincia' => '15'],
            ['codigo' => '3509', 'nombre' => 'GUANTANAMO', 'codigo_provincia' => '15'],
            ['codigo' => '3510', 'nombre' => 'Niceto Perez', 'codigo_provincia' => '15'],
        ];

        foreach ($municipios as $municipio) {
            // Buscar provincia por código
            $provincia = Provincia::where('codigo', $municipio['codigo_provincia'])->first();
            
            if ($provincia) {
                Municipio::create([
                    'codigo' => $municipio['codigo'],
                    'nombre' => $municipio['nombre'],
                    'codigo_provincia' => $municipio['codigo_provincia'],
                    'provincia_id' => $provincia->id
                ]);
            }
        }
    }
}
