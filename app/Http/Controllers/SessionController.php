<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(Request $request){
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        if (auth()->user()->id_tipo == 1){
            return redirect()->to('/admin');
        }
        else{
            return redirect()->to('/');

        }
    }

    return back()->withErrors(['message' => 'Email y/o contraseña incorrecta']);
}
    

    public function destroy(){
        auth()->logout();
        return redirect()->to('/');
    }
}

