<?php

namespace Database\Factories;

use App\Models\NotaMedica;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;

/**
 * @extends Factory<NotaMedica>
 */
class NotaMedicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Relación con un paciente existente o uno nuevo
            'paciente_id' => Paciente::factory(),
            
            // 2. Motivo de consulta
            'motivo_consulta' => $this->faker->randomElement([
                'Dolor lumbar persistente',
                'Dificultad al orinar',
                'Control post-operatorio',
                'Revisión de estudios de laboratorio',
                'Hematuria macroscópica'
            ]),

            // 3. Antecedentes
            'antecedentes_heredofamiliares' => 'Padre con cáncer de próstata. Madre con diabetes tipo 2.',
            'antecedentes_personales_patologicos' => 'Hipertensión arterial controlada con Enalapril.',
            'antecedentes_quirurgicos' => $this->faker->randomElement(['Apendicectomía (2010)', 'Ninguno', 'Colecistectomía (2018)']),
            'alergias' => $this->faker->randomElement(['Penicilina', 'Ninguna conocida', 'Sulfa']),
            'medicamentos_actuales' => $this->faker->randomElement(['Enalapril 10mg/día', 'Ninguno', 'Metformina 850mg']),

            // 4. Padecimiento actual
            'padecimiento_actual' => $this->faker->paragraph(3),

            // 5. Exploración física
            'signos_vitales' => 'TA: 120/80 mmHg, FC: 75 lpm, FR: 18 rpm, Temp: 36.7°C, Peso: 80kg',
            'exploracion_urologica_dirigida' => 'Abdomen blando, depresible. Puño percusión renal bilateral negativa. Genitales externos sin alteraciones.',

            // 6. Estudios
            'estudios_laboratorio' => 'Antígeno prostático específico (PSA) en rangos normales.',
            'estudios_imagen' => 'Ultrasonido renal muestra quiste simple en polo superior izquierdo.',
            'estudios_patologia' => 'Pendiente de toma de biopsia.',

            // 7. Diagnóstico CIE-10
            'diagnostico_cie10' => $this->faker->randomElement(['N40.X (Hiperplasia de la próstata)', 'N30.0 (Cistitis aguda)', 'R31 (Hematuria no especificada)']),

            // 8. Plan
            'tratamiento' => $this->faker->sentence(),
            'indicaciones' => 'Incrementar ingesta de líquidos (2L/día). Evitar irritantes.',
            'proxima_cita' => $this->faker->dateTimeBetween('now', '+6 months'),

            // 9. Firma y Cédula
            'cedula_profesional' => 'CED-' . $this->faker->numberBetween(1000000, 9999999),
        ];
    }
}
