@extends('layouts.layout')

@section('title', 'Editar Nota Médica')

@section('content')
<div class="container-fluid px-4 pb-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Edición de Nota Clínica</h1>
        <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="fas fa-undo me-1"></i> Regresar
        </a>
    </div>

    {{-- Resumen del Paciente (Solo Lectura) --}}
    <div class="card mb-4 border-0 shadow-sm bg-light">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 text-primary"><i class="fas fa-user-md me-2"></i>{{ $paciente->nombre }}</h5>
                <span class="badge bg-secondary">Expediente: {{ $paciente->numero_expediente }}</span>
                <span class="badge bg-info text-dark">Sede: {{ $paciente->sede }}</span>
            </div>
            <div class="text-end">
                <small class="text-muted d-block">Fecha de Nota Original:</small>
                <strong>{{ $nota->created_at->format('d/m/Y') }}</strong>
            </div>
        </div>
    </div>

    {{-- Formulario de Actualización --}}
    <form action="{{ route('notas.update', $nota->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- SECCIÓN 1: EVALUACIÓN CLÍNICA --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h6 class="mb-0"><i class="fas fa-notes-medical me-2"></i>1. Evaluación del Paciente</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Motivo de Consulta</label>
                        <textarea name="motivo_consulta" class="form-control no-resize @error('motivo_consulta') is-invalid @enderror" rows="2" required>{{ old('motivo_consulta', $nota->motivo_consulta) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Padecimiento Actual</label>
                        <textarea name="padecimiento_actual" class="form-control no-resize" rows="4">{{ old('padecimiento_actual', $nota->padecimiento_actual) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Exploración Urológica Dirigida</label>
                        <textarea name="exploracion_urologica_dirigida" class="form-control no-resize" rows="4">{{ old('exploracion_urologica_dirigida', $nota->exploracion_urologica_dirigida) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Signos Vitales</label>
                        <input type="text" name="signos_vitales" class="form-control" value="{{ old('signos_vitales', $nota->signos_vitales) }}" placeholder="Ej: TA 120/80, Temp 36.5°C...">
                    </div>
                </div>
            </div>
        </div>

        {{-- SECCIÓN 2: AUXILIARES DE DIAGNÓSTICO --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white py-3">
                <h6 class="mb-0"><i class="fas fa-flask me-2"></i>2. Estudios y Resultados</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Laboratorio</label>
                        <textarea name="estudios_laboratorio" class="form-control no-resize" rows="3">{{ old('estudios_laboratorio', $nota->estudios_laboratorio) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Imagen</label>
                        <textarea name="estudios_imagen" class="form-control no-resize" rows="3">{{ old('estudios_imagen', $nota->estudios_imagen) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Patología</label>
                        <textarea name="estudios_patologia" class="form-control no-resize" rows="3">{{ old('estudios_patologia', $nota->estudios_patologia) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECCIÓN 3: IMPRESIÓN DIAGNÓSTICA Y PLAN --}}
        <div class="card mb-4 shadow-sm border-bottom">
            <div class="card-header bg-success text-white py-3">
                <h6 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>3. Diagnóstico y Tratamiento</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Diagnóstico (CIE-10)</label>
                        <input type="text" name="diagnostico_cie10" class="form-control @error('diagnostico_cie10') is-invalid @enderror" value="{{ old('diagnostico_cie10', $nota->diagnostico_cie10) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-danger">Próxima Cita</label>
                        <input type="date" name="proxima_cita" class="form-control" value="{{ old('proxima_cita', $nota->proxima_cita ? \Carbon\Carbon::parse($nota->proxima_cita)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tratamiento</label>
                        <textarea name="tratamiento" class="form-control no-resize" rows="4" required>{{ old('tratamiento', $nota->tratamiento) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Indicaciones</label>
                        <textarea name="indicaciones" class="form-control no-resize" rows="4" required>{{ old('indicaciones', $nota->indicaciones) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTONES DE ACCIÓN --}}
        <div class="d-flex justify-content-end gap-3 mb-5">
            <a href="{{ route('pacientes.index') }}" class="btn btn-lg btn-outline-danger shadow-sm px-4">
                Cancelar
            </a>
            <button type="submit" class="btn btn-lg btn-primary shadow-sm px-5">
                <i class="fas fa-save me-2"></i>Guardar Nota Médica
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .no-resize { resize: none; }
    .card { border: none; border-radius: 10px; }
    .card-header { border-top-left-radius: 10px !important; border-top-right-radius: 10px !important; }
</style>
@endpush
@endsection
