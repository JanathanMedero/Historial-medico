@extends('layouts.layout')

@section('title')
    Nuevo Paciente
@endsection

@section('content')

    <main>
        <div class="container-fluid px-4 pb-5">
            <h1 class="mt-4">Registro Integral de Paciente</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('pacientes.index') }}">Pacientes</a></li>
                <li class="breadcrumb-item active">Nuevo Registro</li>
            </ol>

            <form action="{{ route('pacientes.store') }}" method="POST">
                @csrf

                {{-- SECCIÓN 1: DATOS DE IDENTIFICACIÓN --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-user me-1"></i> 1. Identificación del Paciente
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="numero_expediente" class="form-label">N° Expediente</label>
                                <input type="text" name="numero_expediente" id="numero_expediente" class="form-control" placeholder="Ej: EXP-001" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre y Apellidos" required>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select name="sexo" id="sexo" class="form-select" required>
                                    <option value="" selected disabled>Seleccione sexo...</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="sede" class="form-label">Sede</label>
                                <select name="sede" id="sede" class="form-select" required>
                                    <option value="" selected disabled>Seleccione la sede...</option>
                                    <option value="Sede Norte">Sede Norte</option>
                                    <option value="Sede Sur">Sede Sur</option>
                                    <option value="Sede Central">Sede Central</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 2: MOTIVO Y ANTECEDENTES --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-history me-1"></i> 2. Motivo y Antecedentes
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="motivo_consulta" class="form-label font-weight-bold">Motivo de Consulta</label>
                                <textarea name="motivo_consulta" id="motivo_consulta" class="form-control no-resize" rows="2" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="ant_heredofamiliares" class="form-label">Heredofamiliares</label>
                                <textarea name="antecedentes_heredofamiliares" id="ant_heredofamiliares" class="form-control no-resize" rows="2"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="ant_patologicos" class="form-label">Personales Patológicos</label>
                                <textarea name="antecedentes_personales_patologicos" id="ant_patologicos" class="form-control no-resize" rows="2"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="ant_quirurgicos" class="form-label">Quirúrgicos</label>
                                <textarea name="antecedentes_quirurgicos" id="ant_quirurgicos" class="form-control no-resize" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="alergias" class="form-label text-danger font-weight-bold">Alergias</label>
                                <textarea name="alergias" id="alergias" class="form-control no-resize" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="medicamentos_actuales" class="form-label">Medicamentos Actuales</label>
                                <textarea name="medicamentos_actuales" id="medicamentos_actuales" class="form-control no-resize" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 3: EVALUACIÓN CLÍNICA --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-stethoscope me-1"></i> 3. Evaluación y Exploración
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="padecimiento_actual" class="form-label font-weight-bold">Padecimiento Actual</label>
                                <textarea name="padecimiento_actual" id="padecimiento_actual" class="form-control no-resize" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="signos_vitales" class="form-label">Signos Vitales</label>
                                <textarea name="signos_vitales" id="signos_vitales" class="form-control no-resize" rows="2" placeholder="TA, FC, FR, Temp, Peso..."></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="exploracion_fisica" class="form-label">Exploración Urológica Dirigida</label>
                                <textarea name="exploracion_urologica_dirigida" id="exploracion_fisica" class="form-control no-resize" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 4: ESTUDIOS, DIAGNÓSTICO Y PLAN --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <i class="fas fa-file-medical me-1"></i> 4. Resultados y Plan
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="est_laboratorio" class="form-label">Estudios de Laboratorio</label>
                                <textarea name="estudios_laboratorio" id="est_laboratorio" class="form-control no-resize" rows="2"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="est_imagen" class="form-label">Estudios de Imagen</label>
                                <textarea name="estudios_imagen" id="est_imagen" class="form-control no-resize" rows="2"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="est_patologia" class="form-label">Estudios de Patología</label>
                                <textarea name="estudios_patologia" id="est_patologia" class="form-control no-resize" rows="2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="diagnostico" class="form-label font-weight-bold">Diagnóstico (CIE-10)</label>
                                <input type="text" name="diagnostico_cie10" id="diagnostico" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tratamiento" class="form-label text-success font-weight-bold">Tratamiento</label>
                                <textarea name="tratamiento" id="tratamiento" class="form-control no-resize" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="indicaciones" class="form-label">Indicaciones</label>
                                <textarea name="indicaciones" id="indicaciones" class="form-control no-resize" rows="3" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="proxima_cita" class="form-label">Próxima Cita</label>
                                <input type="date" name="proxima_cita" id="proxima_cita" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOTONES DE ACCIÓN --}}
                <div class="d-flex justify-content-end gap-2 mb-5">
                    <a href="{{ route('pacientes.index') }}"
                    class="btn btn-danger btn-lg px-4 d-inline-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-ban me-2"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                    <i class="fas fa-save me-2"></i>Finalizar y Guardar
                </button>
            </div>
        </form>
    </div>
</main>
@push('styles')
    <style>
    .no-resize {
        resize: none;
    }
    </style>
@endpush
@endsection
