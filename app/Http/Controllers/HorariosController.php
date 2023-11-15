<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HorariosController extends Controller
{
    public function store(Request $request)
    {
        $horario = new Horario;
        $horario->rut_profesional = $request->rut_profesional;
        $horario->dia = $request->dia;
        $horario->hora_inicio = $request->hora_inicio;
        $horario->hora_fin = $request->hora_fin;

        $horario->save();
        return redirect()->route('secretaria.horarios');
       
    }
}
