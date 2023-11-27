<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'disponibilidad';
    protected $primaryKey = ['rut_profesional','hora_inicio','hora_fin'];
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function rut_profesional()
    {
        return $this->belongsTo(Profesional::class, 'rut_profesional');
    }
}
