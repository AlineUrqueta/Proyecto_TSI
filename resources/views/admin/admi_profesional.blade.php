@extends('layouts.master')
@section('title','Mantenedor de profesionales')
@section('contenido')
<div class="row mt-5 ">
    <div class="col-sm-12 col-md-8  order-md-first order-sm-last">
        <form action="{{route('profesional.search')}}" method="GET">
            @csrf
            <div class="row mb-4">
                <div class="col-6">
                    <input type="text" name="buscar" placeholder="Buscar profesional por nombre o especialidad" class="form-control">
                </div>
                <div class="col-4">
                    <button type="" class='btn btn-success '>Buscar</button>
                </div>
            </div>
        </form>
        @if (count($profesionales) === 0)
        <div class="alert alert-danger">No hay profesionales registrados</div>
        @else
        <table class="table table-bordered border-success" style="width: auto; height: auto;">
            <thead>
                <tr>
                    <th scope="col">RUT</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">ESPECIALIDAD</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">FONO</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">ACCION</th>
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
                    <td>{{$profesional->fono}}</td>
                    @if ($profesional->estado_vigente == 1)
                    <td class="text-center"><span class="material-symbols-outlined">
                            check
                        </span>
                    </td>
                    @else
                    <td class="text-center"><span class="material-symbols-outlined">
                            do_not_disturb_on
                        </span>
                    </td>
                    @endif
                    <td>

                        <a class='btn btn-warning text-white' href="{{route('profesional.edit',$profesional->rut_profesional)}}"><span class="material-symbols-outlined">
                                manufacturing
                            </span></a>

                    </td>
                </tr>

                @endforeach


            </tbody>
        </table>
        @endif


    </div>

    <div class="col-sm-12 col-md-4  mb-sm-5 order-md-last order-sm-first">
        <div class="card" style="width: auto; height: auto;">
            <div class="card-header text-center">
                <h4>Registro de Profesional</h4>
            </div>
            <div class="card-body">


                <form action="{{route('profesional.store')}}" class='mt-4' method='POST'>
                    @csrf
                    <div class='m-3'>
                        <input type="text" placeholder='RUT Profesional' class="form-control" id="rut_profesional" name="rut_profesional">
                        <small class="ms-2"> Formato: 9999999-K</small>
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Nombre' id='nom_profesional' name='nom_profesional' class="form-control" value="{{ old('nom_profesional') }}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Paterno' id='apep_profesional' name='apep_profesional' class="form-control" value="{{ old('apep_profesional') }}">
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Apellido Materno' id='apem_profesional' name='apem_profesional' class="form-control" value="{{ old('apem_profesional') }}">
                    </div>


                    <div class='m-3'>
                        <select class="custom-select custom-select-lg mb-3 form-control" id="id_especialidad" name="id_especialidad">
                            <option value=""> -- Seleccione Especialidad -- </option>
                            @foreach ($especialidades as $especialidad)
                            <option value="{{$especialidad->id_especialidad}}">{{$especialidad->nom_especialidad}} </option>
                            @endforeach

                        </select>
                    </div>

                    <div class='m-3'>
                        <input type="text" placeholder='Celular' id='fono' name='fono' class="form-control" value="{{ old('fono') }}">
                    </div>

                    <div class='m-3'>
                        <input type="email" placeholder='Email' class="form-control" name='email' id='email' value="{{ old('email') }}">
                    </div>


                    <div class='me-3 mt-4 text-end'>
                        <a href="{{route('admin.index')}}" class="btn btn-outline-dark me-2">Menu Principal</a>
                        <button type='submit' class='btn btn-success '>Registrar Profesional</button>
                    </div>



                </form>

                <div class='m-3'>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Por favor solucione los siguientes errores: </p>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>


                    </div>
                    @endif

                </div>
            </div>






        </div>
    </div>

</div>



@endsection
