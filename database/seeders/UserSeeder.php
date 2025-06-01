<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        // Usuario Administrador
        User::create([
            'name' => 'Manager Proyect',
            'username' => 'manager',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'activo' => true,
            'telefono' => '+5355555555',
            'cargo' => 'Administrador del Sistema',
            'avatar' => null,
            'last_login_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Usuario Comercial
        User::create([
            'name' => 'Comercial Principal',
            'username' => 'comercial1',
            'email' => 'comercial@gmail.com',
            'password' => Hash::make('comercial'),
            'role' => 'comercial',
            'activo' => true,
            'telefono' => '+5355555556',
            'cargo' => 'Especialista Comercial',
            'avatar' => null,
            'last_login_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Usuario de Soporte (adicional)
        User::create([
            'name' => 'Soporte Técnico',
            'username' => 'soporte',
            'email' => 'soporte@gmail.com',
            'password' => Hash::make('soporte'),
            'role' => 'comercial',
            'activo' => true,
            'telefono' => '+5355555557',
            'cargo' => 'Técnico de Soporte',
            'avatar' => null,
            'last_login_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Usuario de Consulta (solo lectura)
        User::create([
            'name' => 'Consulta General',
            'username' => 'consulta',
            'email' => 'consulta@gmail.com',
            'password' => Hash::make('consulta'),
            'role' => 'comercial',
            'activo' => true,
            'telefono' => '+5355555558',
            'cargo' => 'Usuario de Consulta',
            'avatar' => null,
            'last_login_at' => null,
            'email_verified_at' => now(),
        ]);

        // Crear 5 usuarios de prueba adicionales
        User::factory()->count(5)->create();
    }
}
