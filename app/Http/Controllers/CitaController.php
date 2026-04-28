<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::all();

        return view('pages.citas.index', compact('citas'));
    }

    public function getEvents()
    {
        $citas = Cita::all();

        $eventos = $citas->map(function ($cita) {
            return [
                'id'    => $cita->id,
                'title' => $cita->paciente ? $cita->paciente->nombre : 'Paciente desconocido', // Lo que se verá en el recuadro
                'start' => $cita->fecha_inicio,    // Formato YYYY-MM-DD HH:mm:ss
                // Si no tienes fecha_fin, FullCalendar asume una duración estándar
                'extendedProps' => [
                    'paciente_nombre'       => $cita->paciente ? $cita->paciente->nombre : 'Paciente no encontrado',
                    'motivo_consulta'       => $cita->motivo_consulta,
                    'estado_actual'         => $cita->estado_actual,
                    'plan'                  => $cita->plan,
                    'notas'                 => $cita->notas,
                ]
            ];
        });

        return response()->json($eventos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        //
    }
}
