<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_expediente' => 'EXP-' . $this->faker->unique()->numberBetween(1000, 9999),
            'nombre' => $this->faker->name(),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2010-01-01'),
            'sexo' => $this->faker->randomElement(['Masculino', 'Femenino', 'Otro']),
            'sede' => $this->faker->randomElement(['HNSS', 'Star Médica', 'Pátzcuaro']),
        ];
    }
}
