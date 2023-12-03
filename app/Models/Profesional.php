<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profesional extends Model
{
    use HasFactory;
    protected $table = 'profesionales';
    protected $primaryKey = 'rut_profesional';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad_profesional');
    }

    public function horario()
    {
        return $this->hasMany(Horario::class,'rut_profesional');
    }

    public function atenciones()
    {
        return $this->hasMany(Atencion::class, 'rut_profesional_atenciones');
    }
}
