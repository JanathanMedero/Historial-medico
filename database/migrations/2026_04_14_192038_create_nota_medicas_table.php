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
        // 2. TABLA DE NOTAS MÉDICAS / CONSULTAS
        Schema::create('notas_medicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');

            // Punto 2: Motivo de consulta
            $table->text('motivo_consulta');

            // Punto 3: Antecedentes
            $table->text('antecedentes_heredofamiliares')->nullable();
            $table->text('antecedentes_personales_patologicos')->nullable();
            $table->text('antecedentes_quirurgicos')->nullable();
            $table->text('alergias')->nullable();
            $table->text('medicamentos_actuales')->nullable();

            // Punto 4: Padecimiento actual
            $table->text('padecimiento_actual');

            // Punto 5: Exploración física
            $table->text('signos_vitales'); // Se puede guardar como JSON o texto largo
            $table->text('exploracion_urologica_dirigida');

            // Punto 6: Estudios
            $table->text('estudios_laboratorio')->nullable();
            $table->text('estudios_imagen')->nullable();
            $table->text('estudios_patologia')->nullable();

            // Punto 7: Diagnóstico
            $table->string('diagnostico_cie10'); // Código CIE-10

            // Punto 8: Plan
            $table->text('tratamiento');
            $table->text('indicaciones');
            $table->date('proxima_cita')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_medicas');
    }
};
