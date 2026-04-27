<?php

namespace Database\Factories;

use App\Models\Cita;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaInicio = $this->faker->dateTimeBetween('now', '+1 month');
        
        return [
                    // ID aleatorio entre 1 y 10 como solicitaste
                    'paciente_id' => $this->faker->numberBetween(1, 10),

                    'motivo_consulta' => $this->faker->randomElement([
                        'Dolor abdominal agudo',
                        'Control de hipertensión',
                        'Seguimiento post-operatorio',
                        'Revisión de rutina',
                        'Fiebre y malestar general'
                    ]),

                    'estado_actual' => $this->faker->paragraph(1), // Breve descripción del estado del paciente

                    'plan' => $this->faker->sentence(), // Ej: "Solicitar laboratorios de sangre"

                    'fecha_inicio' => $fechaInicio,

                    'notas' => $this->faker->optional()->sentence(), // Nota opcional
                ];
    }
}
