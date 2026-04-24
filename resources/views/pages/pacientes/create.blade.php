@extends('layouts.layout')

@section('title')
    Nuevo Paciente
@endsection

@section('content')

    <main>
        <div class="container-fluid px-4 pb-5">
            <h1 class="mt-4">Registro Integral de Paciente</h1>

            {{-- Bloque de errores --}}
            @if ($errors->any())
                <div class="alert alert-danger shadow-sm font-weight-bold">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pacientes.store') }}" method="POST" id="formPaciente">
                @csrf

                {{-- SECCIÓN 1: DATOS DE IDENTIFICACIÓN Y CONTACTO --}}
                <div class="card mb-4 shadow-sm border-start border-primary border-4">
                    <div class="card-header bg-primary text-white font-weight-bold">
                        <i class="fas fa-user-medical me-1"></i> 1. Identificación y Datos de Contacto
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="nombre" class="form-label font-weight-bold">Nombre Completo</label>
                                <input type="text" name="nombre" id="nombre"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    placeholder="Nombre y Apellidos" value="{{ old('nombre') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="fecha_nacimiento" class="form-label font-weight-bold text-primary">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                    class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                    value="{{ old('fecha_nacimiento') }}" required>

                                <div class="form-check mt-2 bg-light p-2 rounded border">
                                    <input class="form-check-input ms-0 me-2 border-primary" type="checkbox" id="desconoce_fecha" name="desconoce_fecha">
                                    <label class="form-check-label text-primary small fw-bold" for="desconoce_fecha">
                                        ¿No sabe su fecha de nacimiento?
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="edad" class="form-label font-weight-bold">Edad</label>
                                <input type="number" name="edad" id="edad"
                                    class="form-control @error('edad') is-invalid @enderror"
                                    placeholder="--" value="{{ old('edad') }}" readonly>
                                <small id="msg_manual" class="text-danger fw-bold" style="display:none;">Ingreso Manual</small>
                            </div>

                            <div class="col-md-3">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select name="sexo" id="sexo" class="form-select" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="estado_civil" class="form-label">Estado Civil</label>
                                <select name="estado_civil" id="estado_civil" class="form-select">
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="Soltero/a" {{ old('estado_civil') == 'Soltero/a' ? 'selected' : '' }}>Soltero/a</option>
                                    <option value="Casado/a" {{ old('estado_civil') == 'Casado/a' ? 'selected' : '' }}>Casado/a</option>
                                    <option value="Divorciado/a" {{ old('estado_civil') == 'Divorciado/a' ? 'selected' : '' }}>Divorciado/a</option>
                                    <option value="Viudo/a" {{ old('estado_civil') == 'Viudo/a' ? 'selected' : '' }}>Viudo/a</option>
                                    <option value="Unión Libre" {{ old('estado_civil') == 'Unión Libre' ? 'selected' : '' }}>Unión Libre</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" placeholder="10 dígitos" value="{{ old('telefono') }}">
                            </div>

                            <div class="col-md-8">
                                <label for="domicilio" class="form-label">Domicilio Completo</label>
                                <input type="text" name="domicilio" id="domicilio" class="form-control" placeholder="Calle, Colonia, Ciudad" value="{{ old('domicilio') }}">
                            </div>

                            <div class="col-md-4">
                                <label for="refiere" class="form-label">Referido por</label>
                                <input type="text" name="refiere" id="refiere" class="form-control" value="{{ old('refiere') }}">
                            </div>

                            <div class="col-md-12">
                                <label for="sede" class="form-label font-weight-bold text-dark">Sede de Atención</label>
                                <select name="sede" id="sede" class="form-select" required>
                                    <option value="" selected disabled>Seleccione sede...</option>
                                    <option value="Sede Norte">Sede Norte</option>
                                    <option value="Sede Sur">Sede Sur</option>
                                    <option value="Sede Central">Sede Central</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 2: MOTIVO Y ANTECEDENTES --}}
                <div class="card mb-4 shadow-sm border-start border-info border-4">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-history me-1"></i> 2. Motivo y Antecedentes
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="motivo_consulta" class="form-label font-weight-bold">Motivo de Consulta</label>
                                <textarea name="motivo_consulta" id="motivo_consulta" class="form-control no-resize" rows="2" required>{{ old('motivo_consulta') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Heredofamiliares</label>
                                <textarea name="antecedentes_heredofamiliares" class="form-control no-resize" rows="2">{{ old('antecedentes_heredofamiliares') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Personales Patológicos</label>
                                <textarea name="antecedentes_personales_patologicos" class="form-control no-resize" rows="2">{{ old('antecedentes_personales_patologicos') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quirúrgicos</label>
                                <textarea name="antecedentes_quirurgicos" class="form-control no-resize" rows="2">{{ old('antecedentes_quirurgicos') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-danger fw-bold">Alergias</label>
                                <textarea name="alergias" class="form-control no-resize border-danger" rows="2">{{ old('alergias') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Medicamentos Actuales</label>
                                <textarea name="medicamentos_actuales" class="form-control no-resize" rows="2">{{ old('medicamentos_actuales') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Otros</label>
                                <textarea name="otros" class="form-control no-resize" rows="2" placeholder="Información adicional...">{{ old('otros') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 3: EVALUACIÓN Y SIGNOS VITALES --}}
                <div class="card mb-4 shadow-sm border-start border-secondary border-4">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-stethoscope me-1"></i> 3. Evaluación y Exploración Física
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label font-weight-bold">Padecimiento Actual - Interrogatorio</label>
                                <textarea name="padecimiento_actual" class="form-control no-resize" rows="3" required>{{ old('padecimiento_actual') }}</textarea>
                            </div>

                            {{-- SIGNOS VITALES (SIN PESO) --}}
                            <div class="col-12">
                                <p class="text-primary fw-bold mb-2 border-bottom pb-1"><i class="fas fa-heartbeat me-1"></i> Signos Vitales</p>
                            </div>
                            <div class="col-md col-6">
                                <label class="form-label">Tensión Arterial</label>
                                <input type="text" name="tension_arterial" class="form-control" placeholder="120/80" value="{{ old('tension_arterial') }}">
                            </div>
                            <div class="col-md col-6">
                                <label class="form-label">Frec. Cardiaca (LPM)</label>
                                <input type="text" name="frecuencia_cardiaca" class="form-control" placeholder="70" value="{{ old('frecuencia_cardiaca') }}">
                            </div>
                            <div class="col-md col-6">
                                <label class="form-label">Frec. Resp. (RPM)</label>
                                <input type="text" name="frecuencia_respiratoria" class="form-control" placeholder="18" value="{{ old('frecuencia_respiratoria') }}">
                            </div>
                            <div class="col-md col-6">
                                <label class="form-label">Temperatura (°C)</label>
                                <input type="text" name="temperatura" class="form-control" placeholder="36.5" value="{{ old('temperatura') }}">
                            </div>
                            <div class="col-md col-6">
                                <label class="form-label">Sat. en Sangre (%)</label>
                                <input type="text" name="saturacion_sangre" class="form-control" placeholder="98" value="{{ old('saturacion_sangre') }}">
                            </div>

                            <div class="col-12 mt-3">
                                <label class="form-label">Exploración Física / Urológica Dirigida</label>
                                <textarea name="exploracion_urologica_dirigida" class="form-control no-resize" rows="2">{{ old('exploracion_urologica_dirigida') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 4: ESTUDIOS Y DIAGNÓSTICO AUXILIAR --}}
                <div class="card mb-4 shadow-sm border-start border-warning border-4">
                    <div class="card-header bg-warning text-dark font-weight-bold">
                        <i class="fas fa-microscope me-1"></i> 4. Estudios de Auxiliares de Diagnóstico
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Estudios de Laboratorio</label>
                                <textarea name="estudios_laboratorio" class="form-control no-resize" rows="3"
                                    placeholder="Biometría, Química sanguínea...">{{ old('estudios_laboratorio') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Estudios de Imagen</label>
                                <textarea name="estudios_imagen" class="form-control no-resize" rows="3"
                                    placeholder="Ultrasonido, TAC, Rayos X...">{{ old('estudios_imagen') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Estudios de Patología</label>
                                <textarea name="estudios_patologia" class="form-control no-resize" rows="3"
                                    placeholder="Biopsias, Citologías...">{{ old('estudios_patologia') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN 5: RESULTADOS Y PLAN --}}
                <div class="card mb-4 shadow-sm border-start border-dark border-4">
                    <div class="card-header bg-dark text-white font-weight-bold">
                        <i class="fas fa-file-medical me-1"></i> 5. Resultados y Plan
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label font-weight-bold font-italic text-primary">Diagnóstico (CIE-10) Otro si aplica</label>
                                <input type="text" name="diagnostico_cie10" class="form-control border-primary" value="{{ old('diagnostico_cie10') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-success font-weight-bold font-italic">Tratamiento Sugerido</label>
                                <textarea name="tratamiento" class="form-control no-resize border-success" rows="3">{{ old('tratamiento') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Indicaciones / Recomendaciones</label>
                                <textarea name="indicaciones" class="form-control no-resize" rows="3">{{ old('indicaciones') }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Próxima Cita</label>
                                <input type="date" name="proxima_cita" class="form-control" value="{{ old('proxima_cita') }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end gap-3 mb-5">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-danger px-4">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                        <i class="fas fa-save me-2"></i>Guardar Expediente
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('desconoce_fecha');
            const inputFecha = document.getElementById('fecha_nacimiento');
            const inputEdad = document.getElementById('edad');
            const msgManual = document.getElementById('msg_manual');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    inputFecha.value = "";
                    inputFecha.disabled = true;
                    inputFecha.required = false;
                    inputFecha.style.backgroundColor = "#e9ecef";
                    inputEdad.readOnly = false;
                    inputEdad.required = true;
                    inputEdad.value = "";
                    inputEdad.focus();
                    inputEdad.classList.add('border-danger');
                    msgManual.style.display = "block";
                } else {
                    inputFecha.disabled = false;
                    inputFecha.required = true;
                    inputFecha.style.backgroundColor = "#fff";
                    inputEdad.readOnly = true;
                    inputEdad.required = false;
                    inputEdad.value = "";
                    inputEdad.classList.remove('border-danger');
                    msgManual.style.display = "none";
                }
            });

            inputFecha.addEventListener('change', function() {
                if (this.value && !checkbox.checked) {
                    const hoy = new Date();
                    const nacimiento = new Date(this.value);
                    let edadCalculada = hoy.getFullYear() - nacimiento.getFullYear();
                    const mes = hoy.getMonth() - nacimiento.getMonth();
                    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
                        edadCalculada--;
                    }
                    inputEdad.value = edadCalculada;
                }
            });
        });
    </script>
@endsection

@push('styles')
<style>
    .no-resize { resize: none; }
    .form-label { font-size: 0.9rem; margin-bottom: 0.2rem; font-weight: 500; }
    .card-header { font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
    input:disabled { cursor: not-allowed !important; }
</style>
@endpush
