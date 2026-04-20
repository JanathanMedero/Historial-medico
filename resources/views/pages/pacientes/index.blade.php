@extends('layouts.layout')

@section('title')
    Pacientes
@endsection

@section('content')

    <main>
        <div class="container-fluid mt-4 px-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-0">Gestión de Pacientes</h2>
                    <p class="text-muted">Panel administrativo de expedientes</p>
                </div>
                <a href="{{ route('pacientes.create') }}" class="btn btn-primary shadow-sm">
                    <strong>+</strong> Nuevo Paciente
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
                    <livewire:paciente-table />
                </div>
            </div>
        </div>
    </main>
    @endsection
