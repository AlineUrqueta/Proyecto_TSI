<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function showUsuario(){
        return view('admin.admi_usuario');
    }

    public function showProfesional(){
        return view('admin.admi_profesional');
    }

    public function showEspecialidad(){
        return view('admin.admi_especialidad');
    }
}
