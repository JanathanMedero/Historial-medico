<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\NotaMedica;
use App\Http\Requests\StoreNotasRequest;

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

    public function create($paciente_id)
    {
        $paciente = Paciente::where('id', $paciente_id)->first();

        return view('pages.notas.create', compact('paciente'));
    }

    public function store(StoreNotasRequest $request)
    {
        // 1. Validación de los datos clínicos
        $validated = $request->validate([

            // Datos de la Nota Médica
            'motivo_consulta'   => 'required|string',
            'padecimiento_actual' => 'required|string',
            'diagnostico_cie10' => 'required|string',
            'tratamiento'       => 'required|string',
            'indicaciones'      => 'required|string',
            'proxima_cita'      => 'nullable|date',

            // Campos opcionales (nullable)
            'antecedentes_heredofamiliares'      => 'nullable|string',
            'antecedentes_personales_patologicos' => 'nullable|string',
            'antecedentes_quirurgicos'           => 'nullable|string',
            'alergias'                           => 'nullable|string',
            'medicamentos_actuales'              => 'nullable|string',
            'signos_vitales'                     => 'nullable|string',
            'exploracion_urologica_dirigida'     => 'nullable|string',
            'estudios_laboratorio'               => 'nullable|string',
            'estudios_imagen'                    => 'nullable|string',
            'estudios_patologia'                 => 'nullable|string',
        ]);

        try {
            // 2. Creación de la nota vinculada al paciente
            // Usamos el modelo NotaMedica directamente
            NotaMedica::create([
                'paciente_id'       => $request->paciente_id,
                'motivo_consulta'   => $validated['motivo_consulta'],
                'antecedentes_heredofamiliares'      => $validated['antecedentes_heredofamiliares'],
                'antecedentes_personales_patologicos' => $validated['antecedentes_personales_patologicos'],
                'antecedentes_quirurgicos'           => $validated['antecedentes_quirurgicos'],
                'alergias'                           => $validated['alergias'],
                'medicamentos_actuales'              => $validated['medicamentos_actuales'],
                'padecimiento_actual'                => $validated['padecimiento_actual'],
                'signos_vitales'                     => $validated['signos_vitales'],
                'exploracion_urologica_dirigida'     => $validated['exploracion_urologica_dirigida'],
                'estudios_laboratorio'               => $validated['estudios_laboratorio'],
                'estudios_imagen'                    => $validated['estudios_imagen'],
                'estudios_patologia'                 => $validated['estudios_patologia'],
                'diagnostico_cie10'                  => $validated['diagnostico_cie10'],
                'tratamiento'                        => $validated['tratamiento'],
                'indicaciones'                       => $validated['indicaciones'],
                'proxima_cita'                       => $validated['proxima_cita'],
            ]);

            // 3. Redirección al historial del paciente con mensaje de éxito
            return redirect()->route('notas.index', $request->paciente_id)
            ->with('success', 'Nueva nota médica registrada correctamente.');

        } catch (\Exception $e) {
            dd($e);
            // En caso de error, regresamos con los datos para no perder lo escrito
            return back()->withInput()->with('error', 'No se pudo guardar la nota: ' . $e->getMessage());
        }
    }

}
