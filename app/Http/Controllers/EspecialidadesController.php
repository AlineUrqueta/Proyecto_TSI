<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Http\Requests\EspecialidadRequest;

class EspecialidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidades = Especialidad::all();
        return view('admin.admi_especialidad',compact('especialidades'));
    }

    public function show(Especialidad $especialidad){ // Mostrar una lista con los profesionales que tienen esa especialidad
        //
    }

    public function search(Request $request){
        $buscar = $request->buscar;
        $especialidades = Especialidad::where('nom_especialidad', 'LIKE', "%$buscar%")-> get();
        return view('admin.admi_especialidad', compact('especialidades'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EspecialidadRequest $request)
    {
        $especialidad = new Especialidad;
        $especialidad->nom_especialidad = $request->nom_especialidad;
        $especialidad->save();
        return redirect() -> route('especialidad.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especialidad $especialidad)
    {
        return view('admin.editar_especialidad',compact('especialidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EspecialidadRequest $request, Especialidad $especialidad)
    {
        $especialidad->nom_especialidad = $request->nom_especialidad;
        $especialidad->save();
        return redirect() -> route('especialidad.edit',compact('especialidad'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidad $especialidad)
    {
        //$profesionales = DB::table('profesionales')->where('id_especialidad', $id_especialidad)->count();
        /* if ($profesionales === 0){
            return $especialidad->delete();
        }
        else{
            $error = 'bla bla bla';
            return $error;
        } */

        $especialidad->delete();
        return redirect()->route('especialidad.index');
    }
}
