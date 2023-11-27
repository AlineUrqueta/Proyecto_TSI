@extends('layouts.master')
@section('title','Mantenedor de horarios')
@section('contenido')
<div class="row mt-5">
    <div class="col-sm-12 col-md-8  order-md-first order-sm-last">
        <form action="{{route('profesional.search')}}" method="GET">
            @csrf
            <div class="row mb-4">
                <div class="col-6">
                    <input type="text" name="buscar" placeholder="Buscar horario por profesional" class="form-control">
                </div>
                <div class="col-4">
                    <button type="" class='btn btn-success '>Buscar</button>
                </div>
            </div>
        </form>

        @if (count($profesionales) === 0)
        <div class="alert alert-danger">No hay profesionales registrados</div>
        @else
        <table class="table table-bordered border-success  class ='btn btn-warning'">
            <thead>
                <tr>
                    <th scope="col">RUT</th>
                    <th scope="col">NOMBRE COMPLETO</th>
                    <th scope="col">ESPECIALIDAD</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">HORARIO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profesionales as $profesional )
                <tr>
                    <th>{{$profesional->rut_profesional}}</th>
                    <th>{{$profesional->nom_profesional}} {{$profesional->apep_profesional}} {{$profesional->apem_profesional}}</th>

                    @foreach ($especialidades as $especialidad )
                    @if ($especialidad->id_especialidad == $profesional->id_especialidad_profesional)
                    <th>{{$especialidad->nom_especialidad}}</th>
                    @endif
                    @endforeach
                    <td>{{$profesional->email}}</td>
                    <td>

                        <a class='btn btn-warning text-white d-inline-flex' href="{{ route('secretaria.editarHorario') }}"><span class="material-symbols-outlined">
                                settings
                            </span></a>
                        <a class='btn btn-primary text-white d-inline-flex' href="{{ route('secretaria.verHorario') }}"><span class="material-symbols-outlined">
                                calendar_today
                            </span></a>

                    </td>
                </tr>

                @endforeach


            </tbody>
        </table>
        @endif

    </div>

    <div class="col-md-4  mb-sm-5 order-md-last order-sm-first">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Agregar Horario</h4>
            </div>
            <div class="card-body">


                <form action="{{route('horario.store')}}" class='mt-4' method='POST'>
                    @csrf
                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id='rut_profesional' name='rut_profesional'>
                            <option value=""> --- Seleccionar Profesional ---</option>
                            @foreach ($profesionales as $profesional )
                            <option value="{{$profesional->rut_profesional}}">{{$profesional->nom_profesional}} {{$profesional->apep_profesional}} {{$profesional->apem_profesional}}</option>
                            @endforeach
                        </select>





                        <div class="col">
                            <select class="custom-select custom-select-lg mb-3 form-control" id='dia' name='dia'>
                                <option value=""> --- Seleccionar Dia ---</option>

                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miércoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sabado</option>

                            </select>

                        </div>
                        

                        <div class="col">
                            <div class="mb-3">
                                <select class="form-select" id="hora_inicio" name="hora_inicio">
                                    <option value="">Hora de inicio</option>
                                    <option value="1">9:00</option>
                                    <option value="2">9:45</option>
                                    <option value="3">10:30</option>
                                    <option value="4">11:15</option>
                                    <option value="5">12:00</option>
                                    <option value="6">12:45</option>
                                    <option value="7">13:30</option>
                                    <option value="8">14:15</option>
                                    <option value="9">15:00</option>
                                    <option value="10">15:45</option>
                                    <option value="11">16:30</option>
                                    <option value="12">17:15</option>
                                    <option value="13">18:00</option>
                                    <option value="14">18:45</option>
                                    <option value="15">19:30</option>
                                    <option value="16">20:15</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" id="hora_fin" name="hora_fin">
                                    <option value="">Hora de termino</option>
                                    <option value="1">9:45</option>
                                    <option value="2">10:30</option>
                                    <option value="3">11:15</option>
                                    <option value="4">12:00</option>
                                    <option value="5">12:45</option>
                                    <option value="6">13:30</option>
                                    <option value="7">14:15</option>
                                    <option value="8">15:00</option>
                                    <option value="9">15:45</option>
                                    <option value="10">16:30</option>
                                    <option value="11">17:15</option>
                                    <option value="12">18:00</option>
                                    <option value="13">18:45</option>
                                    <option value="14">19:30</option>
                                    <option value="15">20:15</option>
                                    <option value="16">21:00</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger m-3">
                        <ul>
                            @php
                            $contador = 0;
                            @endphp

                            @foreach ($errors->all() as $error)
                            @if (strpos($error, 'Esta disponibilidad ya fue registrada') === 0 && $contador === 0)
                            <li>{{ $error }}</li>
                            @php
                            $contador++;
                            @endphp
                            @elseif (strpos($error, 'Esta disponibilidad ya fue registrada') !== 0)
                            <li>{{ $error }}</li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif



                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('secretaria.index')}}" class="btn btn-outline-dark me-2">Menu Principal</a>
                        <button type='submit' class='btn btn-success '>Registrar Horario</button>
                    </div>





                </form>
            </div>

        </div>
    </div>

</div>



@endsection
