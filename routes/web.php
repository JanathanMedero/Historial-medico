<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'layouts.layout')->name('dashboard');

    //Pacientes
    

});

require __DIR__.'/settings.php';
