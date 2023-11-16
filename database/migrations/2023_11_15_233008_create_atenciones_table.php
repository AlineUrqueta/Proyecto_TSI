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
        Schema::create('atenciones', function (Blueprint $table) {
            $table->integer('id_atencion')->autoIncrement();

            $table->string('rut_paciente_atenciones');
            $table->foreign('rut_paciente_atenciones')->references('rut_paciente')->on('pacientes');
            
            $table->string('rut_profesional_atenciones');
            $table->foreign('rut_profesional_atenciones')->references('rut_profesional')->on('profesionales');

            $table->date('fecha_atencion');
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->string('email_usuario',50);
            $table->foreign('email_usuario')->references('email')->on('usuarios');

            $table->tinyInteger('estado_atencion')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atenciones');
    }
};
