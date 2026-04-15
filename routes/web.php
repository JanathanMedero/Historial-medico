<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'layouts.layout')->name('dashboard');

    //Pacientes
    Route::get('pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::view('pacientes/crear', 'pages.pacientes.index')->name('pacientes.create');
    Route::get('/pacientes/{paciente}', [PacienteController::class, 'show'])->name('pacientes.show');

});

require __DIR__.'/settings.php';
