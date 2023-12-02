@extends('layouts.master')
@section('title','Datos Paciente')
@section('contenido')


<div class="mt-5">
    <div class="row">
        <div class="row mb-2">
            <div class="col-10">
                <h3>Datos personales </h3>
            </div>
            <div class="col-2 text-end">
                <a class="btn btn-success " href="{{route('pacientes.index')}}">Volver a Pacientes</a>
            </div>
            

        </div>
        <div>
          <hr>
        </div>

        <h5>Nombre : {{$paciente->nom_paciente}} {{$paciente->apep_paciente}} {{$paciente->apem_paciente}}</h5>
        <h5>Fecha de nacimiento : {{$paciente->fecha_nacimiento}} </h5>
        <h5>Celular : {{$paciente->fono}} </h5>
        @if($paciente->corp_tea == 1)
        <h5>Corporacion TEA: Si pertenece </h5>
        @else
        <h5>Corporacion TEA: No pertenece </h5>
        @endif


    </div>


</div>

<div class="mt-5">
    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha | Hora</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Médico tratante</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($atenciones as $atencion )

                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$atencion->fecha_atencion}} {{$atencion->hora_inicio}}</td>
                    <td>{{$atencion->profesional->especialidad->nom_especialidad}}</td>
                    <td>{{$atencion->profesional->nom_profesional}} {{$atencion->profesional->apep_profesional}}</td>
                </tr>
                
            @endforeach
            
        </tbody>

    </table>


</div>
@endsection
