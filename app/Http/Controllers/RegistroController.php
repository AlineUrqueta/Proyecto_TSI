<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;

class RegistroController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(UsuarioRequest $request){
        $usuario = new Usuario;
        $usuario->nom_usuario = $request->nom_usuario;
        $usuario->apep_usuario = $request->apep_usuario;
        $usuario->apem_usuario = $request->apem_usuario;
        $usuario->fono = $request->fono;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->id_tipo = 2;
        $usuario->save();
        auth()->login($usuario);
        return redirect()->to('/');
    }
}
