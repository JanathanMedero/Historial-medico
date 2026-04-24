<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\NotaMedicaController;

//Route::view('/', 'welcome')->name('home');

Route::view('/', 'pages.auth.login')->name('login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'layouts.layout')->name('dashboard');

    // Pacientes
    Route::get('pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::get('pacientes/crear', [PacienteController::class, 'create'])->name('pacientes.create');

    // Para editar (el formulario)
    Route::get('pacientes/{paciente}/editar', [PacienteController::class, 'edit'])->name('pacientes.edit');

    // Para mostrar
    Route::get('pacientes/{paciente}', [PacienteController::class, 'show'])->name('pacientes.show');

    // Para guardar nuevo
    Route::post('pacientes', [PacienteController::class, 'store'])->name('pacientes.store');

    // PARA ACTUALIZAR (CORREGIDA)
    Route::put('pacientes/{paciente}', [PacienteController::class, 'update'])->name('pacientes.update');

    //Pacientes
    //Route::get('pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
    //Route::get('pacientes/crear', [PacienteController::class, 'create'])->name('pacientes.create');
    //Route::get('/numero-paciente/{paciente}', [PacienteController::class, 'edit'])->name('pacientes.edit');
    //Route::get('/pacientes/{paciente}', [PacienteController::class, 'show'])->name('pacientes.show');
    //Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
    //Route::put('/pacientes/{paciente_actualizado}', [PacienteController::class, 'update'])->name('pacientes.update');

    Route::get('notas-medicas-paciente/{paciente}', [NotaMedicaController::class, 'index'])->name('notas.index');
    Route::get('nota/{id}/editar', [NotaMedicaController::class, 'edit'])->name('notas.edit');
    Route::get('nota/crear-nueva-nota/{paciente}', [NotaMedicaController::class, 'create'])->name('notas.create');
    Route::put('nota/{id}', [NotaMedicaController::class, 'update'])->name('notas.update');
    Route::post('nota/creada', [NotaMedicaController::class, 'store'])->name('notas.store');

});

require __DIR__.'/settings.php';
