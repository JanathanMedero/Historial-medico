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

        Schema::create('historials', function (Blueprint $table) {

            $table->id();
            // Relación con el paciente
            $table->foreignId('paciente_id')->unique()->constrained('pacientes')->onDelete('cascade');

            // 2. Motivo y Antecedentes
            $table->text('motivo_consulta');
            $table->text('antecedentes_heredofamiliares');
            $table->text('antecedentes_personales_patologicos');
            $table->text('antecedentes_quirurgicos');
            $table->text('alergias');
            $table->text('medicamentos_actuales');
            $table->text('otros')->nullable();

            // 3. Evaluación y Exploración
            $table->text('padecimiento_actual');
            $table->text('frecuencia_cardiaca')->nullable();
            $table->text('temperatura')->nullable();
            $table->text('tension_arterial')->nullable();
            $table->text('frecuencia_respiratoria')->nullable();
            $table->text('saturacion_sangre')->nullable();
            $table->text('exploracion_urologica_dirigida');

            //  4. Estudios de Auxiliares de Diagnóstico
            $table->text('estudios_laboratorio')->nullable();
            $table->text('estudios_imagen')->nullable();
            $table->text('estudios_patologia')->nullable();


            $table->string('diagnostico_cie10');
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
        Schema::dropIfExists('historials');
    }
};
