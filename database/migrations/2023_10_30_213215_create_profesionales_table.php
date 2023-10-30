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
        Schema::create('profesionales', function (Blueprint $table) {
            $table->string('rut_profesional')->primary(); 
            $table->string('nom_profesional',50);
            $table->string('apep_profesional',50);
            $table->string('apem_profesional',50);
            $table->string('fono',13); //Es String porque se considera el +  //  
            $table->string('email',50);
            $table->tinyIncrements('id_especialidad_profesional');
            $table->foreign('id_especialidad_profesional')->references('id_especialidad')->on('especialidades');
            $table->tinyInteger('estado_vigente')->default(1);

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales');
    }
};