<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\Paciente;
use App\Models\Especialidad;
use App\Models\Profesional;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Http\Requests\AtencionesRequest;
use Carbon\Carbon;

class AtencionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        $profesionales = Profesional::where('estado_vigente','=',1)->get();
        $especialidades = Especialidad::has('profesionales')->get();
        $atenciones = Atencion::orderByDesc('fecha_atencion')->get();
        $horas = array("9:00", "9:45", "10:30", "11:15", "12:00", "12:45", "13:30", "14:15", "15:00", "15:45", "16:30", "17:15", "18:00", "18:45", "19:30", "20:15");
        return view('secretaria.agendar_hora',compact('pacientes','profesionales','especialidades','atenciones','horas'));
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

    public function obtenerHorasDisponibles($profesionalId, $fechaSeleccionada)
    {
        try {
            $atenciones = Atencion::where('rut_profesional_atenciones', $profesionalId) //Agendadas
                    ->whereDate('fecha_atencion', $fechaSeleccionada)
                    ->where('estado_atencion', 1)
                    ->pluck('hora_inicio');

            //Todas las horas        
            $horas = array("9:00", "9:45", "10:30", "11:15", "12:00", "12:45", "13:30", "14:15", "15:00", "15:45", "16:30", "17:15", "18:00", "18:45", "19:30", "20:15");
            
            //todas menos las agendadas
            $horasDisponibles = array_diff($horas, $atenciones->toArray());

            return response()->json(array_values($horasDisponibles));
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
    public function store(AtencionesRequest $request)
    {
        $fecha_atencion = Carbon::parse($request->fecha_atencion);
        

        $atencion = new Atencion;
        $atencion->rut_paciente_atenciones = $request->rut_paciente_atenciones;
        $atencion->rut_profesional_atenciones = $request->rut_profesional_atenciones;
        $atencion->fecha_atencion = $fecha_atencion;
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

    public function indexListado()
    {
        $atencionesAgendadas = Atencion::where('estado_atencion',"LIKE",1)->whereDate('fecha_atencion', '>=', Carbon::now())->get();
        

        $atencionesPorConfirmar = Atencion::where('estado_atencion', 1)
            ->whereDate('fecha_atencion', '>=', Carbon::now()->addDays(3))
            ->get();

        $atencionesConfirmadas = Atencion::where('estado_atencion', 2)
        ->whereDate('fecha_atencion', '>=', Carbon::now())
        ->get();

        $atencionesCanceladas = Atencion::where('estado_atencion', 0)
        ->whereDate('fecha_atencion', '>=', Carbon::now())
        ->get();


        return view('secretaria.listadoCitas',compact('atencionesAgendadas','atencionesPorConfirmar','atencionesConfirmadas','atencionesCanceladas'));
    }

    
    public function show(Atencion $atencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atencion $atencion)
    {   $pacientes = Paciente::all();
        $profesionales = Profesional::where('estado_vigente','=',1)->get();
        $especialidades = Especialidad::all();
        return view('secretaria.editarHora',compact('atencion','pacientes','profesionales','especialidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtencionesRequest $request, Atencion $atencion)
    {
        $fecha_atencion = Carbon::parse($request->fecha_atencion);
        $hora_inicio = Carbon::parse($request->hora_inicio);
        $hora_fin = Carbon::parse($request -> hora_fin);

        $atencion = new Atencion;
        $atencion->rut_paciente_atenciones = $request->rut_paciente;
        $atencion->rut_profesional_atenciones = $request->rut_profesional;
        
        $atencion->fecha_atencion = $fecha_atencion;
        $atencion->hora_inicio = $hora_inicio;
        $atencion->hora_fin = $hora_fin;
        $atencion->email_usuario = auth()->user()->email;
        $atencion->estado_atencion = 1;
        $atencion->save();

        return redirect()->route('secretaria.editarHora',compact('atencion'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atencion $atencion)
    {
        //
    }
}
