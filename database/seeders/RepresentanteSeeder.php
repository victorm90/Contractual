<?php

namespace Database\Seeders;

use App\Models\Contrato;
use App\Models\Representante;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepresentanteSeeder extends Seeder
{
    public function run()
    {
        // Obtener el usuario comercial (asumiendo que existe)
        $userComercial = User::where('username', 'comercial')->first();

        // Si no existe, crear uno temporal
        if (!$userComercial) {
            $userComercial = User::create([
                'name' => 'Comercial Temporal',
                'username' => 'comercial_temp',
                'email' => 'comercial_temp@example.com',
                'password' => bcrypt('password'),
                'role' => 'comercial'
            ]);
        }

        // Obtener contratos existentes
        $contratos = Contrato::all();        

        $representantes = [
            [
                'contrato_id' => $contratos[0]->id,
                'CIdentidad' => '79100424919',
                'NRepresentante' => 'Aliosha Lopez Calmell',
                'Activo' => true,
                'CargoRepresentante' => 'REPRESENTANTE',
                'user_id' => $userComercial->id
            ],
            [
                'contrato_id' => $contratos[1]->id,
                'CIdentidad' => '83120825862',
                'NRepresentante' => 'Roque Rodríguez Maine',
                'Activo' => true,
                'CargoRepresentante' => 'Representante',
                'user_id' => $userComercial->id
            ],
            [
                'contrato_id' => $contratos[2]->id,
                'CIdentidad' => '00000408509',
                'NRepresentante' => 'Milder Lobaina Galano',
                'Activo' => true,
                'CargoRepresentante' => 'Representante',
                'user_id' => $userComercial->id
            ],            
        ];

        foreach ($representantes as $representante) {
            Representante::create($representante);
        }       
    }
}
