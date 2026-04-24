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
        // Si llega aquí, los datos ya son válidos
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            // 2. Generar número de expediente único de 5 dígitos
            do {
                $numeroExpediente = mt_rand(10000, 99999);
            }while (Paciente::where('numero_expediente', $numeroExpediente)->exists());

            $validated['numero_expediente'] = $numeroExpediente;

            $paciente = Paciente::create($validated);

            $paciente->historial()->create($validated);

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
        $paciente->where('name', 'pattern');

        return view('pages.pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(UpdatePacienteRequest $request, Paciente $paciente)
 {
     // 1. Validación de los datos
     // Nota: Si ya usas UpdatePacienteRequest, las reglas deberían estar allá.
     // Pero si las dejas aquí, asegúrate de que UpdatePacienteRequest tenga authorize() en true.
     $request->validate([
         'numero_expediente' => 'required|unique:pacientes,numero_expediente,' . $paciente->id,
         'nombre'            => 'required|string|max:255',
         'fecha_nacimiento'  => 'required|date',
         'sexo'              => 'required|in:Masculino,Femenino,Otro',
         'sede'              => 'required|string',
     ]);

     try {
         DB::beginTransaction();

         // 2. Actualizamos los datos del Paciente
         $paciente->update([
             'numero_expediente' => $request->numero_expediente,
             'nombre'            => $request->nombre,
             'fecha_nacimiento'  => $request->fecha_nacimiento,
             'sexo'              => $request->sexo,
             'sede'              => $request->sede,
         ]);

         DB::commit();

         return redirect()->route('pacientes.index')
             ->with('success', 'El expediente de ' . $paciente->nombre . ' ha sido actualizado correctamente.');

     } catch (\Exception $e) {
         DB::rollBack();
         return back()->withInput()->with('error', 'Ocurrió un error al actualizar: ' . $e->getMessage());
     }
 }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
