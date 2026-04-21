@extends('layouts.layout')

@section('title', 'Editar Paciente: ' . $paciente->nombre)

@section('content')
    <main>
        <div class="container-fluid px-4 pb-5">
            <h1 class="mt-4">Editar Expediente Médico</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('pacientes.index') }}">Pacientes</a></li>
                <li class="breadcrumb-item active">Editar</li>
                <li class="breadcrumb-item active">{{ $paciente->nombre }}</li>
            </ol>

            {{-- Bloque de errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario apuntando al método update con spoofing PUT --}}
            <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Requerido por Laravel para actualizaciones --}}

                {{-- Enviamos el número de expediente de forma oculta --}}
                <input type="hidden" name="numero_expediente" value="{{ $paciente->numero_expediente }}">

                {{-- SECCIÓN 1: DATOS DE IDENTIFICACIÓN --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-user me-1"></i> 1. Identificación del Paciente
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <input type="text" name="nombre" id="nombre"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre', $paciente->nombre) }}" required>
                                @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                    class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                    value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>
                                @error('fecha_nacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select name="sexo" id="sexo" class="form-select @error('sexo') is-invalid @enderror" required>
                                    <option value="Masculino" {{ old('sexo', $paciente->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('sexo', $paciente->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('sexo', $paciente->sexo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                                @error('sexo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="sede" class="form-label">Sede</label>
                                <select name="sede" id="sede" class="form-select @error('sede') is-invalid @enderror" required>
                                    <option value="Sede Norte" {{ old('sede', $paciente->sede) == 'Sede Norte' ? 'selected' : '' }}>Sede Norte</option>
                                    <option value="Sede Sur" {{ old('sede', $paciente->sede) == 'Sede Sur' ? 'selected' : '' }}>Sede Sur</option>
                                    <option value="Sede Central" {{ old('sede', $paciente->sede) == 'Sede Central' ? 'selected' : '' }}>Sede Central</option>
                                </select>
                                @error('sede') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOTONES DE ACCIÓN --}}
                <div class="d-flex justify-content-end gap-2 mb-5">
                    <a href="{{ route('pacientes.index') }}"
                        class="btn btn-outline-danger d-inline-flex align-items-center justify-content-center"
                        style="min-width: 120px; height: 45px;">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-save me-2"></i>Actualizar Información
                    </button>
                </div>
            </form>
        </div>
    </main>

    @push('styles')
        <style>
            .no-resize { resize: none; }
        </style>
    @endpush
@endsection
