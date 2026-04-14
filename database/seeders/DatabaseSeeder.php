<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Paciente;
use App\Models\NotaMedica;
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
            'name' => 'Admin MedApp',
            'email' => 'medero.janathan@gmail.com',
            'password' => Hash::make('123123'),
        ]);

        // 2. Generar datos de prueba relacionados
        // IMPORTANTE: Para evitar el error "Call to undefined method factory()",
        // verifica que los modelos Paciente y NotaMedica incluyan: use HasFactory;
        Paciente::factory(10)->has(
            NotaMedica::factory()->count(2), 
            'notasMedicas' // Nombre de la relación definida en el modelo Paciente
        )->create();

        /*
        |--------------------------------------------------------------------------
        | OPCIÓN 2: Llamar a Seeders específicos
        |--------------------------------------------------------------------------
        | $this->call([
        |     MedicalSystemSeeder::class,
        | ]);
        */
    }
}
