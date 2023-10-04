@extends('layouts.master')
@section('title','Inicio Secretaria - Centro Médico Epojé')
@section('contenido')
    {{-- <div class="row align-items-center">
        <div class = 'col-6 mt-5'>
            <img src="{{asset('images/logo.jpeg')}}" alt="Logo Centro" class="img-fluid">
        </div>
    </div> --}}

    <div class="container-fluid mt-4 d-flex justify-content-center" style="background-color: #88bd9e">
        <div class="col-5 d-flex justify-content-center">
            <div class="row m-4">
                <div class="card border-light mb-3" style="background-color: #88bd9e">
                    <div class="card-body">
                        <div class="row">
                            <h4 class = "text-center" style="color: white">Bienvenida {{auth()->user()->nom_usuario}} {{auth()->user()->apep_usuario}}</h4>
                        </div>
                        <div class="row m-4">
                            <div class="col d-flex justify-content-center">
                                <img src="{{asset('images/icono_usuario.png')}}" alt="icono usuario" class="img-fluid" style="width: 10rem">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7 d-flex flex-column justify-content-center">
            <div class="row m-4">
                <a class=" btn btn-light btn-lg" href="{{route('secretaria.agendar')}}">Agendar Hora</a>
            </div>
            <div class="row m-4">
                <a class=" btn btn-light btn-lg" href="{{ route('pacientes.index') }}">Administrar Pacientes</a>
            </div>
            <div class="row m-4">

                <a class=" btn btn-light btn-lg" href="{{ route('secretaria.showHorarios') }}">Administrar Horarios</a>

            </div>
        </div>

    </div>

@endsection