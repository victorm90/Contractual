<?php

namespace Database\Seeders;

use App\Models\ClasLegal;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            ClasLegalSeeder::class,
            EmpresaSeeder::class,
            FormPagoSeeder::class,
            ProvinciaSeeder::class,
            MunicipioSeeder::class,
            UserSeeder::class,
            ContratoSeeder::class,
            RepresentanteSeeder::class,
        ]);
    }
}
