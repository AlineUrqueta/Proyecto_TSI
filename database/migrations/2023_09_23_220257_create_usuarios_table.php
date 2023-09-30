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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement(); // podríamos hacer que el email sea la clave primaria
            $table->string('nom_usuario',50);
            $table->string('apep_usuario',50);
            $table->string('apem_usuario',50);
            $table->string('fono',13); //Es String porque se considera el + 
            $table->string('email',50);
            $table->string('password',64); //  
            $table->tinyInteger('id_tipo'); // Admin o Secretaria
            $table->tinyInteger('estado_vigente')->default(1);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
