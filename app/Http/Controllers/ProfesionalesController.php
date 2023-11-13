<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Http\Requests\ProfesionalesRequest;

class ProfesionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidades = Especialidad::all();
        $profesionales = Profesional::orderBy('estado_vigente')->get();
        return view('admin.admi_profesional',compact('especialidades','profesionales'));
        
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
    public function store(ProfesionalesRequest $request)
    {
        $profesional = new Profesional;
        $profesional->rut_profesional = $request->rut_profesional;
        $profesional->nom_profesional = $request->nom_profesional;
        $profesional->apep_profesional = $request->apep_profesional;
        $profesional->apem_profesional = $request->apem_profesional;
        $profesional->fono = $request->fono;
        $profesional->email = $request->email;
        $profesional->id_especialidad_profesional = $request->id_especialidad;
        $profesional->estado_vigente = 1;
        $profesional->save();
        return redirect()->route('admin.indexProfesional');
        
    }

    public function search(Request $request){
        $buscar = $request->buscar;

        $especialidades = Especialidad::where('nom_especialidad', 'LIKE', "%$buscar%")->get();

        $profesionales = Profesional::where('apep_profesional', 'LIKE', "%$buscar%")
        ->orWhere(function ($query) use ($buscar) {
            $query->whereHas('especialidad', function ($subquery) use ($buscar) {
                $subquery->where('nom_especialidad', 'LIKE', "%$buscar%");
            });
        })->orWhere('nom_profesional', 'LIKE', "%$buscar%")->get();
        
        $especialidades = Especialidad::all();
        return view('admin.admi_profesional', compact('profesionales','especialidades'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesional $profesional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesional $profesional)
    {
        $especialidades = Especialidad::all();
        return view('admin.admin_profesional-editar',compact('profesional','especialidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesional $profesional)
    {
        //$profesional->rut_profesional = $request->rut_profesional;

        $profesional->nom_profesional = $request->nom_profesional;
        $profesional->apep_profesional = $request->apep_profesional;
        $profesional->apem_profesional = $request->apem_profesional;
        $profesional->fono = $request->fono;
        $profesional->email = $request->email;
        $profesional->id_especialidad_profesional = $request->id_especialidad_profesional;
        $profesional->estado_vigente = $request->estado_vigente;
        $profesional->save();
        return redirect()->route('profesional.edit',compact('profesional'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesional $profesional)
    {
        //
    }
}
