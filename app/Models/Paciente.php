<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;

class Paciente extends Model
{
    /** @use HasFactory<\Database\Factories\PacienteFactory> */
    use HasFactory;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'numero_expediente',
        'nombre',
        'fecha_nacimiento',
        'edad',
        'sexo',
        'estado_civil',
        'refiere',
        'domicilio',
        'telefono',
        'sede',
    ];


    public function historial()
    {
        // Laravel buscará la tabla 'historial' automáticamente
        return $this->hasOne(Historial::class);
    }

    public function notasMedicas()
    {
        // Asumiendo que tu modelo se llama NotaMedica
        return $this->hasMany(NotaMedica::class);
    }

}
