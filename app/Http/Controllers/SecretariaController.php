<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Requests\UsuarioRequest;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view('secretaria.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('admin.admin_usuario-editar',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $usuario->nom_usuario = $request->nom_usuario;
        $usuario->apep_usuario = $request->apep_usuario;
        $usuario->apem_usuario = $request->apem_usuario;
        $usuario->fono = $request->fono;
        $usuario->estado_vigente = $request->estado_vigente;
        //$usuario->email = $request->email;
        //$usuario->password = Hash::make($request->password);
        //$usuario->id_tipo = $request->id_tipo;
        $usuario->save();
        return redirect()->route('usuario.edit',compact('usuario'))->with('editarCorrecto', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
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

    // public function agendar(){
    //     return view('secretaria.agendar_hora');

    // }

    public function search(Request $request){
        $buscar = $request->buscar;
        $usuarios = Usuario::where('apep_usuario', 'LIKE', "%$buscar%")->orWhere('nom_usuario', 'LIKE', "%$buscar%")->orderBy('estado_vigente','desc')->get();
        return view('admin.admi_usuario',compact('usuarios'));
    }

    
}
