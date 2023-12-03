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
        $pacientes =Paciente::where('estado_vigente','=',1)->get();
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

    public function obtenerHorasDisponibles($profesionalId, $fechaSeleccionada,$pacienteSeleccionado)
    {
        try {
            // $atenciones = Atencion::where('rut_profesional_atenciones', $profesionalId)
            // ->whereDate('fecha_atencion', $fechaSeleccionada)
            // ->whereIn('estado_atencion', [1, 2, 3])
            // ->pluck('hora_inicio');

            // $horas = array("9:00", "9:45", "10:30", "11:15", "12:00", "12:45", "13:30", "14:15", "15:00", "15:45", "16:30", "17:15", "18:00", "18:45", "19:30", "20:15");

            
            $atencionesMedico = Atencion::where('rut_profesional_atenciones', $profesionalId)
            ->whereDate('fecha_atencion', $fechaSeleccionada)
            ->whereIn('estado_atencion', [1, 2, 3])
            ->pluck('hora_inicio');

            $atencionesPaciente = Atencion::where('rut_paciente_atenciones', $pacienteSeleccionado)
                ->whereDate('fecha_atencion', $fechaSeleccionada)
                ->whereIn('estado_atencion', [1, 2, 3])
                ->pluck('hora_inicio');

            $horas = array("9:00", "9:45", "10:30", "11:15", "12:00", "12:45", "13:30", "14:15", "15:00", "15:45", "16:30", "17:15", "18:00", "18:45", "19:30", "20:15");

            $horasDisponibles = array_diff($horas, $atencionesMedico->toArray(), $atencionesPaciente->toArray());

            return response()->json(array_values($horasDisponibles));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
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
            $atencion->estado_atencion = 3;
        }
        
        $atencion->save();
        return redirect()->route('secretaria.listadoCitas');
    }

    public function horaCancelada($atencionId){
        $atencion = Atencion::where('id_atencion', $atencionId)->first();
        $atencion->estado_atencion = 0;
        $atencion->save();
        return redirect()->route('secretaria.listadoCitas');
    }

    public function indexListado()
    {
        $atencionesAgendadas = Atencion::where('estado_atencion',"=",1)->whereDate('fecha_atencion', '>=', Carbon::now())->get();
        
        $fechaFormateada = Carbon::now()->addDays(3)->format('Y-m-d');
        $atencionesPorConfirmar = Atencion::where('estado_atencion', 1)
        ->whereDate('fecha_atencion', '<=', $fechaFormateada)
        ->get();
        
        $atencionesConfirmadas = Atencion::where('estado_atencion',"=",2)
        ->get();

        $atencionesRealizadas = Atencion::where('estado_atencion',"=", 3)->get();

        $atencionesCanceladas = Atencion::where('estado_atencion',"=", 0)->get();
        

        //dd($fechaFormateada);
        return view('secretaria.listadoCitas',compact('atencionesAgendadas','atencionesPorConfirmar','atencionesConfirmadas','atencionesCanceladas','atencionesRealizadas'));
    }

    public function indexFiltrar()
    {
        $atenciones = Atencion::all();
        $profesionales = Profesional::where('estado_vigente', 1)
    ->whereHas('atenciones', function ($query) {
        $query->where('estado_atencion', 1);
    })
    ->get();

        return view('secretaria.filtrarCitas',compact('atenciones','profesionales'));
    }


    public function editView(Atencion $atencion)
    {  
        $profesionales = Profesional::where('estado_vigente','=',1)->get();
        $especialidades = Especialidad::all();
        $horas = array("9:00", "9:45", "10:30", "11:15", "12:00", "12:45", "13:30", "14:15", "15:00", "15:45", "16:30", "17:15", "18:00", "18:45", "19:30", "20:15");
        return view('secretaria.editarAtencion',compact('atencion','profesionales','especialidades','horas'));
    }

    public function update(AtencionesRequest $request, Atencion $atencion)
    {
        $fecha_atencion = Carbon::parse($request->fecha_atencion);
        $atencion->rut_paciente_atenciones = $request->rut_paciente_atenciones;
        $atencion->rut_profesional_atenciones = $request->rut_profesional_atenciones;
        $atencion->fecha_atencion = $fecha_atencion;
        $atencion->hora_inicio = $request->hora_inicio;
        $atencion->hora_fin = $request -> hora_fin;
        $atencion->email_usuario = auth()->user()->email;
        $atencion->estado_atencion = 1;
        $atencion->save();

        return redirect()->route('secretaria.editHora',compact('atencion'))->with('editarCorrecto', 'Atención actualizada!');
    }


}
