<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Paciente;
use App\Models\NotaMedica;
use App\Models\Cita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Semilla de la base de datos de la aplicación.
     */
    public function run(): void
    {
        // 1. Crear un Usuario Administrador fijo para pruebas
        // Esto te permite entrar siempre con: admin@medapp.com / password123
        User::factory()->create([
            'name' => 'Alejandro Gutierrez',
            'email' => 'medero.janathan@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        Paciente::factory(10)->create();

        Cita::factory(10)->create();


    }
}
