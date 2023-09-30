@extends('layouts.master')
@section('title','Inicio - Centro Médico Epojé')
@section('contenido')

    <div class="row">
    <div class="col-6">
        Pacientes
        <a href={{ route('pacientes.index') }}>Ir a Mantenedor de Pacientes</a>
    </div>
    <div class="col-6">
        Horas Médicas
        <a href='#'>Ir a Mantenedor de Horas Médicas</a>
    </div>

    

@endsection