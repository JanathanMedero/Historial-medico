<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaMedica extends Model
{
    use HasFactory;

    protected $table = 'notas_medicas';

    protected $fillable = [
        'paciente_id',
        'motivo_consulta',
        'antecedentes_heredofamiliares',
        'antecedentes_personales_patologicos',
        'antecedentes_quirurgicos',
        'alergias',
        'medicamentos_actuales',
        'padecimiento_actual',
        'signos_vitales',
        'exploracion_urologica_dirigida',
        'estudios_laboratorio',
        'estudios_imagen',
        'estudios_patologia',
        'diagnostico_cie10',
        'tratamiento',
        'indicaciones',
        'proxima_cita',
        'cedula_profesional',
        'firma_digital'
    ];
}
