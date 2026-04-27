<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'paciente_id',
        'motivo_consulta',
        'estado_actual',
        'plan',
        'fecha_inicio',
        'notas'
    ];
}
