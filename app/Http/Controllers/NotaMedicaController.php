<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\NotaMedica;

class NotaMedicaController extends Controller
{
    public function index($id)
    {
        $paciente = Paciente::where('id', $id)->first();

        return view('pages.notas.index', compact('paciente'));
    }

    public function edit($id)
    {
        $nota = NotaMedica::where('id', $id)->first();

        $paciente = Paciente::where('id', $nota->paciente_id)->first();

        return view('pages.notas.edit', compact('nota', 'paciente'));

    }

    public function update(Request $request, $id)
    {
        // 1. Buscamos la nota o lanzamos error 404 si no existe
        $nota = NotaMedica::findOrFail($id);

        // 2. Validación de campos (Asegúrate de incluir todos los campos del formulario)
        $request->validate([
            'motivo_consulta'                => 'required|string',
            'diagnostico_cie10'              => 'required|string',
            'tratamiento'                    => 'required|string',
            'indicaciones'                   => 'required|string',
            'padecimiento_actual'            => 'nullable|string',
            'exploracion_urologica_dirigida' => 'nullable|string',
            'signos_vitales'                 => 'nullable|string',
            'estudios_laboratorio'           => 'nullable|string',
            'estudios_imagen'                => 'nullable|string',
            'estudios_patologia'             => 'nullable|string',
            'proxima_cita'                   => 'nullable|date',
        ]);

        try {
            // 3. Actualización directa mediante asignación masiva (Fillable)
            $nota->update($request->all());

            $paciente = $nota->paciente_id;

            // 4. Redirección con feedback visual al usuario
            return redirect()->route('notas.index', compact('paciente'))
            ->with('success', 'La nota médica ha sido actualizada exitosamente.');

        } catch (\Exception $e) {
            dd($e);
            // En caso de error (ej. problemas con Laragon o la BD)
            return back()->withInput()->with('error', 'Ocurrió un error al guardar: ' . $e->getMessage());
        }
    }
}
