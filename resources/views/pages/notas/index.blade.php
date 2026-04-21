@extends('layouts.layout')

@section('title', 'Historial: ' . $paciente->nombre)

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="mt-4">Historial de Notas Médicas</h1>
            <div class="mt-3">
                {{-- Nuevo botón para crear nota --}}
                <a href="{{ route('notas.create', ['paciente' => $paciente->id]) }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus-circle me-1"></i> Nueva Nota Medica
                </a>
                {{-- Botón Volver --}}
                <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary ms-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
            </div>
        </div>

        <div class="card mb-4 border-0 bg-light">
            <div class="card-body">
                <h5 class="text-primary"><i class="fas fa-user-circle"></i> {{ $paciente->nombre }}</h5>
                <p class="text-muted mb-0">Expediente: <strong>{{ $paciente->numero_expediente }}</strong> | Sede: {{ $paciente->sede }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fs-4"></i>
                    <div>
                        <strong>¡Hecho!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse($paciente->notasMedicas()->latest()->get() as $nota)
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card h-100 shadow-sm border-start border-primary border-4">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">
                                <i class="far fa-calendar-alt me-1 text-primary"></i>
                                {{ $nota->created_at->format('d/m/Y - h:i A') }}
                            </span>
                            <span class="badge bg-primary">Consulta General</span>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title fw-bold text-secondary">Motivo de Consulta:</h6>
                            <p class="card-text text-dark">{{ Str::limit($nota->motivo_consulta, 150) }}</p>

                            <hr class="text-muted opacity-25">

                            <div class="row">
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Diagnóstico:</small>
                                    <span class="text-truncate d-inline-block w-100">{{ $nota->diagnostico_cie10 }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Próxima Cita:</small>
                                    <span>{{ $nota->proxima_cita ? \Carbon\Carbon::parse($nota->proxima_cita)->format('d/m/Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex gap-2 pb-3">
                            <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Editar Nota
                            </a>
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalNota{{ $nota->id }}">
                                <i class="fas fa-eye"></i> Ver Completa
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No hay notas médicas registradas para este paciente.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
