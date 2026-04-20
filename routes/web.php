<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'layouts.layout')->name('dashboard');

    //Pacientes
    Route::get('pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::get('pacientes/crear', [PacienteController::class, 'create'])->name('pacientes.create');
    Route::get('/numero-paciente/{paciente}', [PacienteController::class, 'edit'])->name('pacientes.edit');
    Route::get('/pacientes/{paciente}', [PacienteController::class, 'show'])->name('pacientes.show');
    Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');

});

require __DIR__.'/settings.php';
