<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Aprendiz;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Usuarios del sistema (autenticación + roles)
        |--------------------------------------------------------------------------
        | Contraseña para los tres: "password"
        */

        User::factory()->administrador()->create([
            'name'  => 'Admin Principal',
            'email' => 'admin@gestor.test',
        ]);

        User::factory()->instructor()->create([
            'name'  => 'Instructor Demo',
            'email' => 'instructor@gestor.test',
        ]);

        User::factory()->aprendiz()->create([
            'name'  => 'Aprendiz Demo',
            'email' => 'aprendiz@gestor.test',
        ]);

        // Usuarios extra para llenar la tabla
        User::factory(5)->instructor()->create();
        User::factory(10)->aprendiz()->create();

        /*
        |--------------------------------------------------------------------------
        | Aprendices (datos del CRUD)
        |--------------------------------------------------------------------------
        */

        Aprendiz::factory(50)->create();
    }
}