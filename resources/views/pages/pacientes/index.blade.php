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

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <livewire:paciente-table />
        </div>
    </div>
</div>
        </main>
    @endsection
