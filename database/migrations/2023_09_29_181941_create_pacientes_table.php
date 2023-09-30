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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->string('rut_paciente')->primary();
            $table->string('nom_paciente',50);
            $table->string('apep_paciente',50);
            $table->string('apem_paciente',50);
            $table->string('fono',13); //Es String porque se considera el +  //  
            $table->tinyInteger('corp_tea')->nullable(); // Admin o Secretaria
            $table->tinyInteger('estado_vigente')->default(1);
            $table->date('fecha_nacimiento');
            //$table->timestamps();
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
