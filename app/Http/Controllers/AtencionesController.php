<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Paciente;
use App\Models\Especialidad;
use App\Models\Profesional;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;

class AtencionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        $profesionales = Profesional::where('estado_vigente','=',1)->get();
        $especialidades = Especialidad::all();
        $atenciones = Atencion::all();
        return view('secretaria.agendar_hora',compact('pacientes','profesionales','especialidades','atenciones'));
    }

    //Buscar
    public function profesionalEspecialidad($especialidadId)
    {
        try {
            $profesionales = Profesional::where('id_especialidad_profesional', $especialidadId)->get();
            return response()->json($profesionales);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function especialidadProfesional($profesionalId)
{
    try {
        $profesional = Profesional::findOrFail($profesionalId);
        $especialidad = $profesional->especialidad; 

        return response()->json($especialidad);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
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
        $atencion = new Atencion;
        $atencion->rut_paciente_atenciones = $request->rut_paciente;
        $atencion->rut_profesional_atenciones = $request->rut_profesional;
        $atencion->fecha_atencion = $request->fecha_atencion;
        $atencion->hora_inicio = $request->hora_inicio;
        $atencion->hora_fin = $request -> hora_fin;
        $atencion->email_usuario = auth()->user()->email;
        $atencion->estado_atencion = 1;
        $atencion->save();

        return redirect()->route('secretaria.agendar');

    }

    public function horaAtendida($atencionId){
        $atencion = Atencion::where('id_atencion', $atencionId)->first();
        if($atencion->estado_atencion == 1){
            $atencion->estado_atencion = 2;
        }else{
            $atencion->estado_atencion = 1;
        }
        
        $atencion->save();
        return redirect()->route('secretaria.agendar');
    }

    public function horaCancelada($atencionId){
        $atencion = Atencion::where('id_atencion', $atencionId)->first();
        $atencion->estado_atencion = 0;
        $atencion->save();
        return redirect()->route('secretaria.agendar');
    }

    public function obtenerHoras($fecha)
    {
        $horasSeleccionadas = Atencion::where('fecha_atencion', $fecha)->pluck('hora');

        return response()->json($horasSeleccionadas);
    }


    /**
     * Display the specified resource.
     */
    public function show(Atencion $atencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atencion $atencion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atencion $atencion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atencion $atencion)
    {
        //
    }
}
