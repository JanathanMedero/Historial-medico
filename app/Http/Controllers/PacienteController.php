<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\NotaMedica;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $pacientes = Paciente::all();
          return view('pages.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePacienteRequest $request)
    {

        // 1. Validación de todos los campos del formulario
        $validated = $request->validate([
            // Datos del Paciente
            'nombre'           => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo'             => 'required|in:Masculino,Femenino,Otro',
            'sede'             => 'required|string',

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

        // 2. Inicio de la Transacción
        DB::beginTransaction();

        try {
            // 2. Generar número de expediente único de 5 dígitos
            do {
                $numeroAleatorio = mt_rand(10000, 99999);
            }while (Paciente::where('numero_expediente', $numeroAleatorio)->exists());

            // 3. Crear el Paciente
            // Solo tomamos los campos pertenecientes a la tabla pacientes
            $paciente = Paciente::create([

                //Agregamos un expediente generado automaticamente
                'numero_expediente' => ('EXP-'.$numeroAleatorio),
                'nombre'           => $validated['nombre'],
                'fecha_nacimiento' => $validated['fecha_nacimiento'],
                'sexo'             => $validated['sexo'],
                'sede'             => $validated['sede'],
            ]);

            // 4. Crear la Nota Médica asociada al paciente recién creado
            // Usamos la relación definida en el modelo o asignamos el paciente_id manualmente
            NotaMedica::create([
                'paciente_id'       => $paciente->id,
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

            // 5. Confirmar los cambios si todo salió bien
            DB::commit();

            return redirect()->route('pacientes.index')
                             ->with('success', 'Paciente y nota médica registrados correctamente.');

        } catch (\Exception $e) {
            dd($e);
            // 6. Si algo falla, se deshacen todos los cambios (Rollback)
            DB::rollBack();

            // Opcional: Registrar el error en el log para revisión técnica
            Log::error("Error al registrar paciente: " . $e->getMessage());
            return back()->withInput()->with('error', 'Ocurrió un error al guardar los datos. Inténtalo de nuevo.');
        }


 }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        dd($paciente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        $paciente->load('notasMedicas');

        return view('pages.pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
