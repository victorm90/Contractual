<?php

namespace Database\Seeders;

use App\Models\ClasLegal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasLegalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $classifications = [
            [
                'name' => 'Persona Jurídica Cubana',
                'position' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Persona Jurídica Extranjera',
                'position' => 2,
                'is_active' => true
            ],
            [
                'name' => 'Persona Natural Cubana',
                'position' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Persona Natural Extranjera',
                'position' => 4,
                'is_active' => true
            ],
            [
                'name' => 'Servicio Diplomático',
                'position' => 5,
                'is_active' => true
            ],
            [
                'name' => 'NUL',
                'position' => 6,
                'is_active' => true
            ]
        ];

        foreach ($classifications as $classification) {
            ClasLegal::create($classification);
        }
    }
}
