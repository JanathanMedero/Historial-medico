@extends('layouts.layout')

@section('title')
    Citas médicas
@endsection

@section('content')

    <main>
        <div class="container-fluid mt-4 px-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-0">Gestión de citas</h2>
                    <p class="text-muted">Calendario de citas programadas</p>
                </div>
                <a href="{{ route('pacientes.create') }}" class="btn btn-primary shadow-sm">
                    <strong>+</strong> Nueva Cita
                </a>
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

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="modalCitaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCitaLabel">Detalles de la Cita</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Paciente:</strong> <span id="det-paciente"></span></p>
                    <p><strong>Motivo:</strong> <span id="det-motivo"></span></p>
                    <p><strong>Estado Actual:</strong> <span id="det-estado"></span></p>
                    <p><strong>Plan:</strong> <span id="det-plan"></span></p>
                    <p><strong>Fecha:</strong> <span id="det-fecha"></span></p>
                    <hr>
                    <p><strong>Notas:</strong></p>
                    <p id="det-notas" class="text-muted italic"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
