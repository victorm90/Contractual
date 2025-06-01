<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $provincias = [            
            ['codigo' => '1', 'nombre' => 'Pinar del Rio', 'abreviatura' => 'P'],
            ['codigo' => '2', 'nombre' => 'ARTEMISA', 'abreviatura' => 'A'],
            ['codigo' => '3', 'nombre' => 'LA HABANA', 'abreviatura' => 'L'],
            ['codigo' => '4', 'nombre' => 'Mayabeque', 'abreviatura' => 'X'],
            ['codigo' => '5', 'nombre' => 'Matanzas', 'abreviatura' => 'M'],
            ['codigo' => '6', 'nombre' => 'Villa Clara', 'abreviatura' => 'V'],
            ['codigo' => '7', 'nombre' => 'Cienfuegos', 'abreviatura' => 'F'],
            ['codigo' => '8', 'nombre' => 'Sancti Spíritus', 'abreviatura' => 'S'],
            ['codigo' => '9', 'nombre' => 'Ciego de Ávila', 'abreviatura' => 'C'],
            ['codigo' => '10', 'nombre' => 'Camagüey', 'abreviatura' => 'C'],
            ['codigo' => '11', 'nombre' => 'Las Tunas', 'abreviatura' => 'L'],
            ['codigo' => '12', 'nombre' => 'Holguín', 'abreviatura' => 'H'],
            ['codigo' => '13', 'nombre' => 'Granma', 'abreviatura' => 'G'],
            ['codigo' => '14', 'nombre' => 'Santiago de Cuba', 'abreviatura' => 'S'],
            ['codigo' => '15', 'nombre' => 'Guantánamo', 'abreviatura' => 'G'],
            ['codigo' => '16', 'nombre' => 'Isla de la Juventud', 'abreviatura' => 'I'],
        ];

        foreach ($provincias as $provincia) {
            Provincia::create($provincia);
        }
    }
}
