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
        $usuarios = Usuario::orderBy('estado_vigente','desc')->get();
        return view('admin.admi_usuario',compact('usuarios'));
    }

    

    
}
