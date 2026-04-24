<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     */
    public function authorize(): bool
    {
        // Cambiar a true para permitir que los médicos registrados guarden
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            // 1. Identificación y Datos de Contacto
            'nombre'            => 'required|string|max:255',
            'fecha_nacimiento'  => 'nullable|date',
            'edad'              => 'nullable|integer',
            'sexo'              => 'required|in:Masculino,Femenino,Otro',
            'estado_civil'      => 'nullable|string',
            'telefono'          => 'nullable|string|max:20',
            'domicilio'         => 'nullable|string',
            'refiere'           => 'nullable|string',
            'sede'              => 'required|string',

            // 2. Motivo y Antecedentes

            'motivo_consulta'                       => 'required|string',
            'antecedentes_heredofamiliares'         => 'nullable|string',
            'antecedentes_personales_patologicos'   => 'nullable|string',
            'antecedentes_quirurgicos'              => 'nullable|string',
            'alergias'                              => 'nullable|string',
            'medicamentos_actuales'                 => 'nullable|string',
            'otros'                                 => 'nullable|string',

            // 3. Evaluación y Exploración
            'padecimiento_actual'               => 'required|string',
            'frecuencia_cardiaca'               => 'nullable|string',
            'temperatura'                       => 'nullable|string',
            'tension_arterial'                  => 'nullable|string',
            'frecuencia_respiratoria'           => 'nullable|string',
            'saturacion_sangre'                 => 'nullable|string',
            'exploracion_urologica_dirigida'    => 'string',


            // 4. Estudios de Auxiliares de Diagnóstico
            'estudios_laboratorio'               => 'nullable|string',
            'estudios_imagen'                    => 'nullable|string',
            'estudios_patologia'                 => 'nullable|string',

            // 5. Resultados y Plan
            'diagnostico_cie10'  => 'string',
            'tratamiento'        => 'string',
            'indicaciones'       => 'string',

            'proxima_cita'       => 'nullable|date',
        ];
    }
}
