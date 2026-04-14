<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'layouts.layout')->name('dashboard');

    //Pacientes
    Route::view('pacientes', 'pages.pacientes.index')->name('pacientes.index');

});

require __DIR__.'/settings.php';
