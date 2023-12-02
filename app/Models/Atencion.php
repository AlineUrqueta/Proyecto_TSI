<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    use HasFactory;
    protected $table = 'atenciones';
    protected $primaryKey = 'id_atencion';

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'rut_paciente_atenciones');
    }

    public function profesional()
    {
        return $this->belongsTo(Profesional::class,'rut_profesional_atenciones');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,'email_usuario');
    }


}
