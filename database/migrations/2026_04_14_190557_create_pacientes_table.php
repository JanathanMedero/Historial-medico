<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. TABLA DE PACIENTES (Datos de Identificación)
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_expediente')->unique(); // Punto 1: Número de expediente
            $table->string('nombre');                      // Punto 1: Nombre
            $table->date('fecha_nacimiento');              // Punto 1: Para calcular la Edad
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro']); // Punto 1: Sexo
            $table->string('sede')->nullable();            // Punto 1: Sede
            $table->timestamps();                          // Punto 1: Fecha de registro
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
