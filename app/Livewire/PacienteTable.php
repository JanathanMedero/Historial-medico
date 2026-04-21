<?php

namespace App\Livewire;

use App\Models\Paciente;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
// Importamos el tema de Bootstrap para el ordenamiento
use PowerComponents\LivewirePowerGrid\Themes\Bootstrap5;

final class PacienteTable extends PowerGridComponent
{
    public string $stringBindKey = 'id';
    public string $tableName = 'pacienteTable';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage(25)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Paciente::query()->orderBy('id', 'desc');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('numero_expediente')
            ->add('nombre')
            ->add('fecha_nacimiento_formatted', fn (Paciente $model) => Carbon::parse($model->fecha_nacimiento)->format('d/m/Y'))
            ->add('sexo')
            ->add('sede')
            // Creamos nuestro propio campo de botón
            ->add('mostrar_notas', function (Paciente $model) {
                $url = route('notas.index', $model->id);
                return "<a href='{$url}' class='btn btn-success btn-sm text-white'>Notas Medicas</a>";
            })
            ->add('boton_editar', function (Paciente $model) {
                $url = route('pacientes.edit', $model->id);
                return "<a href='{$url}' class='btn btn-warning btn-sm text-white'>Editar</a>";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Numero expediente', 'numero_expediente')->sortable()->searchable(),
            Column::make('Nombre', 'nombre')->sortable()->searchable(),
            Column::make('Fecha nacimiento', 'fecha_nacimiento_formatted', 'fecha_nacimiento')->sortable(),
            Column::make('Sexo', 'sexo'),
            Column::make('Sede', 'sede')->sortable()->searchable(),

            // Usamos nuestro campo personalizado 'boton_ver'
            Column::make('Mostrar Notas', 'mostrar_notas'),
            Column::make('Editar Paciente', 'boton_editar'),
        ];
    }

}
