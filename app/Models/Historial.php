<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    // Definimos explícitamente el nombre de la tabla por si Laravel busca "historials"
    protected $table = 'historials';

    protected $fillable = [
        'paciente_id',
        'motivo_consulta',
        'antecedentes_heredofamiliares',
        'antecedentes_personales_patologicos',
        'antecedentes_quirurgicos',
        'alergias',
        'medicamentos_actuales',
        'otros',
        'padecimiento_actual',
        'frecuencia_cardiaca',
        'temperatura',
        'tension_arterial',
        'frecuencia_respiratoria',
        'saturacion_sangre',
        'signos_vitales',
        'exploracion_urologica_dirigida',
        'estudios_laboratorio',
        'estudios_imagen',
        'estudios_patologia',
        'diagnostico_cie10',
        'tratamiento',
        'indicaciones',
        'proxima_cita'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
