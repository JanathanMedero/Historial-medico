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
            <form action="{{ route('pacientes.index', $paciente->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Requerido por Laravel para actualizaciones --}}

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

                @php $ultimaNota = $paciente->notasMedicas->last(); @endphp {{-- Acceso a la relación clínica --}}

                {{-- SECCIÓN 2: MOTIVO Y ANTECEDENTES --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-history me-1"></i> 2. Motivo y Antecedentes
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="motivo_consulta" class="form-label fw-bold">Motivo de Consulta</label>
                                <textarea name="motivo_consulta" id="motivo_consulta"
                                    class="form-control no-resize @error('motivo_consulta') is-invalid @enderror"
                                    rows="2" required>{{ old('motivo_consulta', $ultimaNota->motivo_consulta ?? '') }}</textarea>
                                @error('motivo_consulta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="ant_heredofamiliares" class="form-label">Heredofamiliares</label>
                                <textarea name="antecedentes_heredofamiliares" id="ant_heredofamiliares" class="form-control no-resize" rows="2">{{ old('antecedentes_heredofamiliares', $ultimaNota->antecedentes_heredofamiliares ?? '') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="ant_patologicos" class="form-label">Personales Patológicos</label>
                                <textarea name="antecedentes_personales_patologicos" id="ant_patologicos" class="form-control no-resize" rows="2">{{ old('antecedentes_personales_patologicos', $ultimaNota->antecedentes_personales_patologicos ?? '') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="ant_quirurgicos" class="form-label">Quirúrgicos</label>
                                <textarea name="antecedentes_quirurgicos" id="ant_quirurgicos" class="form-control no-resize" rows="2">{{ old('antecedentes_quirurgicos', $ultimaNota->antecedentes_quirurgicos ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="alergias" class="form-label text-danger fw-bold">Alergias</label>
                                <textarea name="alergias" id="alergias" class="form-control no-resize" rows="2">{{ old('alergias', $ultimaNota->alergias ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="medicamentos_actuales" class="form-label">Medicamentos Actuales</label>
                                <textarea name="medicamentos_actuales" id="medicamentos_actuales" class="form-control no-resize" rows="2">{{ old('medicamentos_actuales', $ultimaNota->medicamentos_actuales ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 3: EVALUACIÓN Y EXPLORACIÓN --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-stethoscope me-1"></i> 3. Evaluación y Exploración
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="padecimiento_actual" class="form-label fw-bold">Padecimiento Actual</label>
                                <textarea name="padecimiento_actual" id="padecimiento_actual"
                                    class="form-control no-resize @error('padecimiento_actual') is-invalid @enderror"
                                    rows="3" required>{{ old('padecimiento_actual', $ultimaNota->padecimiento_actual ?? '') }}</textarea>
                                @error('padecimiento_actual') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="signos_vitales" class="form-label">Signos Vitales</label>
                                <textarea name="signos_vitales" id="signos_vitales" class="form-control no-resize" rows="2">{{ old('signos_vitales', $ultimaNota->signos_vitales ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="exploracion_urologica" class="form-label">Exploración Urológica Dirigida</label>
                                <textarea name="exploracion_urologica_dirigida" id="exploracion_urologica" class="form-control no-resize" rows="2">{{ old('exploracion_urologica_dirigida', $ultimaNota->exploracion_urologica_dirigida ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 4: RESULTADOS Y PLAN --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <i class="fas fa-file-medical me-1"></i> 4. Resultados y Plan
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="est_laboratorio" class="form-label">Estudios de Laboratorio</label>
                                <textarea name="estudios_laboratorio" id="est_laboratorio" class="form-control no-resize" rows="2">{{ old('estudios_laboratorio', $ultimaNota->estudios_laboratorio ?? '') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="est_imagen" class="form-label">Estudios de Imagen</label>
                                <textarea name="estudios_imagen" id="est_imagen" class="form-control no-resize" rows="2">{{ old('estudios_imagen', $ultimaNota->estudios_imagen ?? '') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="est_patologia" class="form-label">Estudios de Patología</label>
                                <textarea name="estudios_patologia" id="est_patologia" class="form-control no-resize" rows="2">{{ old('estudios_patologia', $ultimaNota->estudios_patologia ?? '') }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="diagnostico_cie10" class="form-label fw-bold">Diagnóstico (CIE-10)</label>
                                <input type="text" name="diagnostico_cie10" id="diagnostico_cie10"
                                    class="form-control @error('diagnostico_cie10') is-invalid @enderror"
                                    value="{{ old('diagnostico_cie10', $ultimaNota->diagnostico_cie10 ?? '') }}" required>
                                @error('diagnostico_cie10') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tratamiento" class="form-label text-success fw-bold">Tratamiento</label>
                                <textarea name="tratamiento" id="tratamiento" class="form-control no-resize" rows="3" required>{{ old('tratamiento', $ultimaNota->tratamiento ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="indicaciones" class="form-label">Indicaciones</label>
                                <textarea name="indicaciones" id="indicaciones" class="form-control no-resize" rows="3" required>{{ old('indicaciones', $ultimaNota->indicaciones ?? '') }}</textarea>
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
