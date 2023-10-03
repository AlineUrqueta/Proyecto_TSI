<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function index(){
        return view('secretaria.index');
    }

    public function showHorarios(){
        return view('secretaria.horarios');
    }

    public function verHorario(){
        return view('secretaria.verHorario');
    }

    public function editarHorario(){
        return view('secretaria.editarHorario');
    }
}
