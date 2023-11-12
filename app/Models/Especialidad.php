<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;
    protected $table = 'especialidades';
    protected $primaryKey = 'id_especialidad';
    public $timestamps = false;

    public function profesionales()
    {
        return $this->hasMany(Profesional::class,'id_especialidad_profesional');
    }
}
