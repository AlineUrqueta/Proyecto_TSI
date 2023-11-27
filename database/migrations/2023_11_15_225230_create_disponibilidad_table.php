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
        Schema::create('disponibilidad', function (Blueprint $table) {
            $table->string('rut_profesional');
            $table->tinyInteger('dia')->unsigned();
            $table->string('hora_inicio');
            $table->string('hora_fin');
            
            $table->foreign('rut_profesional')->references('rut_profesional')->on('profesionales');
            $table->primary(['rut_profesional','hora_inicio','hora_fin']);
            $table->unique(['rut_profesional', 'hora_inicio', 'hora_fin']);// NO sirve

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilidad');
    }
};
