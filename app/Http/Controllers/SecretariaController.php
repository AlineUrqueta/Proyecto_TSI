<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function index(){
        return view('secretaria.index');
    }
    public function agendar(){
        return view('secretaria.agendar_hora');
    }
}
