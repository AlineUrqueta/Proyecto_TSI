<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table = 'pacientes';
    protected $primaryKey = 'rut_paciente';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function atenciones()
    {
        return $this->hasMany(Atencion::class,'id_atencion');
    }

}
