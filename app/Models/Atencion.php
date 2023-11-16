<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    use HasFactory;
    protected $table = 'atenciones';

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'rut_paciente');
    }

    public function profesional()
    {
        return $this->belongsTo(Profesional::class,'rut_profesional');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,'email');
    }


}
