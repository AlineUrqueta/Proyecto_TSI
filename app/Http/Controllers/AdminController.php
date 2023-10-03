<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class AdminController extends Controller
{
    public function index(){
        
        return view('admin.index');
    }

    public function showUsuario(){
        $usuarios = Usuario::all();
        return view('admin.admi_usuario',compact('usuarios'));
    }

    public function showProfesional(){
        return view('admin.admi_profesional');
    }

    public function showEspecialidad(){
        return view('admin.admi_especialidad');
    }
}
