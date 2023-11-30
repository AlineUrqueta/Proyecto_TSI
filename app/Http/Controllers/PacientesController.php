<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Atencion;
use App\Http\Requests\PacienteRequest;

class PacientesController extends Controller
{
    public function index(){
        $pacientes = Paciente::all();
        return view('pacientes.index',compact('pacientes'));
    }

    public function store(PacienteRequest $request){
        $paciente = new Paciente;
        $paciente->rut_paciente = $request->rut_paciente;
        $paciente->nom_paciente = $request->nom_paciente;
        $paciente->apep_paciente = $request->apep_paciente;
        $paciente->apem_paciente = $request->apem_paciente;
        $paciente->fono = $request->fono;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->corp_tea = $request->corp_tea;
        $paciente->save();
        return redirect()->route('pacientes.index');
    }

    public function search(Request $request){
        $buscar = $request->buscar;
        $pacientes = Paciente::where('apep_paciente', 'LIKE', "%$buscar%")->orWhere('rut_paciente', 'LIKE', "%$buscar%");
        return view('pacientes.index', compact('pacientes'));
    }

    public function destroy(Paciente $paciente){
        //$paciente = Paciente::find($rut_paciente);
        $paciente ->delete();
        return redirect()->route('pacientes.index');

    }

    public function show(Paciente $paciente){
        $rut = $paciente->rut_paciente;
        
        $atenciones = Atencion::where('rut_paciente_atenciones','LIKE',$rut)->orderByDesc('fecha_atencion')->get();
        return view('pacientes.show',compact('paciente','atenciones'));
    }

    public function edit(Paciente $paciente){
        return view('pacientes.edit',compact('paciente'));
    }

    public function update(PacienteRequest $request,  Paciente $paciente){
        $paciente->nom_paciente = $request->nom_paciente;
        $paciente->apep_paciente = $request->apep_paciente;
        $paciente->apem_paciente = $request->apem_paciente;
        $paciente->fono = $request->fono;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->estado_vigente = $request->estado_vigente;
        $paciente->corp_tea = $request->corp_tea;
        $paciente->save();
        return redirect()->route('pacientes.edit',compact('paciente'));
    }
}
